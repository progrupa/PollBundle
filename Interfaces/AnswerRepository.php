<?php

namespace Progrupa\PollBundle\Interfaces;


use Progrupa\PollBundle\Model\PollQuestion;

interface AnswerRepository
{
    public function getResultsForQuestion(PollQuestion $question);
}
