<?php

namespace Progrupa\PollBundle\Interfaces;


use Progrupa\PollBundle\Entity\PollQuestion;

interface AnswerRepository
{
    public function getResultsForQuestion(PollQuestion $question);
}
