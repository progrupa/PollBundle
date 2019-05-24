<?php

namespace Progrupa\PollBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use Progrupa\PollBundle\Model\Poll;
use Progrupa\PollBundle\Model\PollQuestion;

class Results
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * Results constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Poll $poll
     * @return PollResult
     * @throws \Exception
     */
    public function getFullPollResults(Poll $poll)
    {
        return $this->getPollResults($poll, true);
    }

    /**
     * @param Poll $poll
     * @param bool $full
     * @return PollResult
     * @throws \Exception
     */
    public function getPollResults(Poll $poll, $full = false)
    {
        $result = new PollResult($poll);
        foreach ($poll->getQuestions() as $question) {
            if ($question->getIncludeInOverall() || $full) {
                $result->addElementResult($this->getQuestionResult($question));
            }
        }

        return $result;
    }

    /**
     * @param PollQuestion $question
     * @return PollElementResult
     * @throws \Exception
     */
    protected function getQuestionResult(PollQuestion $question)
    {
        $repo = $this->em->getRepository($question::answerClass());
        if (! $repo instanceof AnswerRepository) {
            throw new \InvalidArgumentException('Class does not support result fetching!');
        }

        $elementResult = new PollElementResult($question);
        list($total, $results) = $repo->getResultsForQuestion($question);
        $elementResult->setTotalAnswers($total);
        $elementResult->setResults($results);

        return $elementResult;
    }
}
