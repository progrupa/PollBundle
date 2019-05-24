<?php

namespace Progrupa\PollBundle\Form;


use Progrupa\PollBundle\Model\ClosedAnswer;
use Progrupa\PollBundle\Model\ClosedQuestion;
use Progrupa\PollBundle\Model\PollAnswer;
use Progrupa\PollBundle\Model\PollOption;
use Progrupa\PollBundle\Model\PollQuestion;
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

    public function fromAnswer(PollAnswer $answer)
    {
        if (! $answer instanceof ClosedAnswer) {
            throw new \InvalidArgumentException("Wrong answer type given");
        }

        if ($answer->getQuestion()->getMultiple()) {
            return $answer->getOptions();
        } else {
            return $answer->getOptions()->count() ? $answer->getOptions()->first() : null;
        }
    }
}
