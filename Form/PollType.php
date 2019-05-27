<?php

namespace Progrupa\PollBundle\Form;


use Progrupa\PollBundle\Entity\ClosedAnswer;
use Progrupa\PollBundle\Entity\ClosedQuestion;
use Progrupa\PollBundle\Entity\OpenAnswer;
use Progrupa\PollBundle\Entity\OpenQuestion;
use Progrupa\PollBundle\Entity\Poll;
use Progrupa\PollBundle\Entity\PollAnswer;
use Progrupa\PollBundle\Entity\PollQuestion;
use Progrupa\PollBundle\Entity\YesNoAnswer;
use Progrupa\PollBundle\Entity\YesNoQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PollType extends AbstractType
{
    private $typeMap = [
        YesNoQuestion::class    =>  YesNoQuestionType::class,
        ClosedQuestion::class   =>  ClosedQuestionType::class,
        OpenQuestion::class     =>  OpenQuestionType::class
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $poll = $options['poll'];
        if (! $poll instanceof Poll) {
            throw new \InvalidArgumentException('This form requires the poll defined');
        }
        /** @var PollQuestion[] $questions */
        $questions = [];
        foreach ($poll->getQuestions() as $question) {
            $questions[] = $question;
            $this->addQuestionFields($builder, $question);
        }

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                if (! ($data = $event->getData())) {
                    return;
                }

                $form = $event->getForm();
                $transData = [];
                foreach ($data as $k => $answer) {
                    if (! $form->has($k)) {
                        continue;
                    }

                    $formElement = $form->get($k)->getConfig()->getType()->getInnerType();

                    if ($answer instanceof PollAnswer && $formElement instanceof PollElement) {
                        $transData[$k] = $formElement->fromAnswer($answer);
                    }
                }

                $event->setData($transData);
            }
        );

        $builder->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) use ($questions) {
                $data = $event->getData();
                $answers = [];
                $answerKey = sha1(time() . rand());

                foreach ($questions as $question) {
                    $name = $question->getName();
                    $questionClass = get_class($question);
                    if (array_key_exists($name, $data)) {
                        $answerClass = $questionClass::answerClass();
                        /** @var PollAnswer $answer */
                        $answer = new $answerClass($data[$name]);
                        $answer->setQuestion($question);
                        $answer->setAnswerKey($answerKey);

                        $answers[$name] = $answer;
                    }
                }

                $event->setData($answers);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'poll'  =>  null,
            'csrf_protection' => false,
            'locale'    =>  'en',
        ]);
    }

    private function addQuestionFields(FormBuilderInterface $builder, PollQuestion $question)
    {
        foreach ($this->typeMap as $questionClass => $type) {
            if ($question instanceof $questionClass) {
                $builder->add(
                    $question->getName(),
                    $type,
                    array_merge(
                        [
                            'label' =>  $question->getLabel(),
                            'required'  =>  $question->getRequired(),
                        ],
                        $type::extraOptions($question)
                    )
                );
            }
        }
    }
}
