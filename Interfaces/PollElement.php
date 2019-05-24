<?php

namespace Progrupa\PollBundle\Interfaces;


use Progrupa\PollBundle\Model\PollAnswer;
use Progrupa\PollBundle\Model\PollQuestion;

interface PollElement
{
    public static function extraOptions(PollQuestion $question);

    public function fromAnswer(PollAnswer $answer);
}
