<?php

namespace Progrupa\PollBundle\Interfaces;


use Progrupa\PollBundle\Entity\PollAnswer;
use Progrupa\PollBundle\Entity\PollQuestion;

interface PollElement
{
    public static function extraOptions(PollQuestion $question);

    public function fromAnswer(PollAnswer $answer);
}
