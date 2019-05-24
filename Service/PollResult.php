<?php

namespace Progrupa\PollBundle\Service;


use Progrupa\PollBundle\Model\Poll;

class PollResult
{
    /** @var Poll */
    private $poll;
    /** @var PollElementResult[]|array */
    private $elementResults;

    /**
     * PollResult constructor.
     * @param Poll $poll
     * @param array|PollElementResult[] $elementResults
     */
    public function __construct(Poll $poll = null, $elementResults = null)
    {
        $this->poll = $poll;
        $this->elementResults = $elementResults;
    }

    /**
     * @return Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * @param Poll $poll
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;
    }

    /**
     * @return array|PollElementResult[]
     */
    public function getElementResults()
    {
        return $this->elementResults;
    }

    /**
     * @param PollElementResult $elementResult
     */
    public function addElementResult(PollElementResult $elementResult)
    {
        $this->elementResults[] = $elementResult;
    }

    /**
     * @param array|PollElementResult[] $elementResults
     */
    public function setElementResults($elementResults)
    {
        $this->elementResults = $elementResults;
    }
}
