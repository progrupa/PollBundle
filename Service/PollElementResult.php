<?php

namespace Progrupa\PollBundle\Service;


use Progrupa\PollBundle\Entity\PollQuestion;

class PollElementResult
{
    /** @var PollQuestion */
    private $question;
    /** @var integer */
    private $totalAnswers;
    /** @var array */
    private $results;

    /**
     * PollElementResult constructor.
     * @param PollQuestion $question
     */
    public function __construct(PollQuestion $question = null)
    {
        $this->question = $question;
    }

    /**
     * @return PollQuestion
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param PollQuestion $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return int
     */
    public function getTotalAnswers()
    {
        return $this->totalAnswers;
    }

    /**
     * @param int $totalAnswers
     */
    public function setTotalAnswers($totalAnswers)
    {
        $this->totalAnswers = $totalAnswers;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param array $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }
}
