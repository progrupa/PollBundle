<?php

namespace Progrupa\PollBundle\Form;


use Progrupa\PollBundle\Entity\ClosedAnswer;
use Progrupa\PollBundle\Entity\ClosedAnswerOption;
use Progrupa\PollBundle\Entity\ClosedQuestion;
use Progrupa\PollBundle\Entity\PollAnswer;
use Progrupa\PollBundle\Entity\PollOption;
use Progrupa\PollBundle\Entity\PollQuestion;
use Progrupa\PollBundle\Interfaces\PollElement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClosedQuestionType extends AbstractType implements PollElement
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(
            [
                'class'    =>  PollOption::class,
                'choice_label'  =>  'label',
            ]
        );
    }

    public function getParent()
    {
        return EntityType::class;
    }

    public static function extraOptions(PollQuestion $question)
    {
        if (! $question instanceof ClosedQuestion) {
            throw new \InvalidArgumentException("An instance of ClosedQuestion is required for this form element");
        }

        return [
            'choices' => $question->getOptions(),
            'multiple' => $question->getMultiple(),
            'expanded' => $question->getExpanded(),
        ];
    }

    public static function openOptions(PollQuestion $question)
    {
        if (! $question instanceof ClosedQuestion) {
            throw new \InvalidArgumentException("An instance of ClosedQuestion is required for this form element");
        }

        $options = [];
        /** @var PollOption $option */
        foreach ($question->getOptions() as $option) {
            if ($option->isOpen()) {
                $options[] = $option->getId();
            }
        }
        return $options;
    }

    public function fromAnswer(PollAnswer $answer)
    {
        if (! $answer instanceof ClosedAnswer) {
            throw new \InvalidArgumentException("Wrong answer type given");
        }

        if ($answer->getQuestion()->getMultiple()) {
            $options = [];
            /** @var ClosedAnswerOption $answerOption */
            foreach ($answer->getAnswerOptions() as $answerOption) {
                $options[] = $answerOption->getOption();
            }

            return $options;
        } else {

            return $answer->getAnswerOptions()->count() ? $answer->getAnswerOptions()->first()->getOption() : null;
        }
    }
}
