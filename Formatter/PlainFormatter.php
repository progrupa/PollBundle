<?php

namespace Progrupa\PollBundle\Formatter;

use Progrupa\PollBundle\Interfaces\PollElementResultFormatter;
use Progrupa\PollBundle\Model\OpenAnswer;
use Progrupa\PollBundle\Model\OpenQuestion;
use Progrupa\PollBundle\Model\PollAnswer;
use Progrupa\PollBundle\Service\PollElementResult;

class PlainFormatter implements PollElementResultFormatter
{
    public function format(PollElementResult $elementResult)
    {
        return [
            'type'  => self::TYPE_LIST,
            'answers'   =>  $elementResult->getResults(),
        ];
    }

    public function formatAnswer(PollAnswer $answer)
    {
        if ($answer instanceof OpenAnswer) {
            return $answer->getOpenText();
        }

        return null;
    }

    public function supportedQuestions()
    {
        return [
            OpenQuestion::class,
        ];
    }

}
