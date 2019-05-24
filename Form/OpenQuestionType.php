<?php

namespace Progrupa\PollBundle\Form;


use Progrupa\PollBundle\Model\OpenAnswer;
use Progrupa\PollBundle\Model\PollAnswer;
use Progrupa\PollBundle\Model\PollQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OpenQuestionType extends AbstractType implements PollElement
{
    public function getParent()
    {
        return TextareaType::class;
    }

    public static function extraOptions(PollQuestion $question)
    {
        return [];
    }

    public function fromAnswer(PollAnswer $answer)
    {
        if (! $answer instanceof OpenAnswer) {
            throw new \InvalidArgumentException("Wrong answer type given");
        }
        return $answer->getOpenText();
    }
}
