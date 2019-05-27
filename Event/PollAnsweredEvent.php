<?php

namespace Progrupa\PollBundle\Event;


use Progrupa\PollBundle\Entity\Poll;
use Progrupa\PollBundle\Entity\PollAnswer;
use Symfony\Component\EventDispatcher\Event;

class PollAnsweredEvent extends Event
{
    /** @var Poll */
    private $poll;
    /** @var PollAnswer[] */
    private $answers;

    /**
     * PollAnsweredEvent constructor.
     * @param $poll
     * @param $answers
     */
    public function __construct($poll, $answers)
    {
        $this->poll = $poll;
        $this->answers = $answers;
    }

    /**
     * @return Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * @return PollAnswer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @return null|string
     */
    public function getAnswerKey()
    {
        $answer = reset($this->answers);
        return $answer ? $answer->getAnswerKey() : null;
    }
}
