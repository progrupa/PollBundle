<?php

namespace Progrupa\PollBundle\Form;


use Progrupa\PollBundle\Entity\PollAnswer;
use Progrupa\PollBundle\Entity\PollQuestion;
use Progrupa\PollBundle\Entity\YesNoAnswer;
use Progrupa\PollBundle\Interfaces\PollElement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YesNoQuestionType extends AbstractType implements PollElement
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(
            [
                'choices'   =>  ['app.form.yes' =>  true, 'app.form.no' =>  false],
                'choices_as_values' =>  true,
                'expanded'  =>  true,
                'multiple'  =>  false,
            ]
        );
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public static function extraOptions(PollQuestion $question)
    {
        return [];
    }

    public function fromAnswer(PollAnswer $answer)
    {
        if (! $answer instanceof YesNoAnswer) {
            throw new \InvalidArgumentException("Wrong answer type given");
        }
        return $answer->getYesNo();
    }
}
