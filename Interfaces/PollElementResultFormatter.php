<?php

namespace Progrupa\PollBundle\Interfaces;


use Progrupa\PollBundle\Entity\PollAnswer;
use Progrupa\PollBundle\Service\PollElementResult;

interface PollElementResultFormatter
{
    const TYPE_SINGLE = 'radio';
    const TYPE_MULTIPLE = 'checkbox';
    const TYPE_LIST = 'list';

    /**
     * @param PollElementResult $elementResult
     * @return array
     */
    public function format(PollElementResult $elementResult);

    /**
     * @param PollAnswer $answer
     * @return mixed
     */
    public function formatAnswer(PollAnswer $answer);

    /**
     * @return array|string[]
     */
    public function supportedQuestions();
}
