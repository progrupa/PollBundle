<?php

namespace Progrupa\PollBundle\Repository;


use Progrupa\PollBundle\Model\Poll;
use Progrupa\PollBundle\Model\PollOption;
use Doctrine\ORM\EntityRepository;

class PollOptionRepository extends EntityRepository
{
    /**
     * @param Poll $poll
     * @param string $question
     * @return PollOption[]
     */
    public function fetchPollOptions(Poll $poll, $question = null)
    {
        $qb = $this->createQueryBuilder('po')
            ->select('po')
            ->join('po.question', 'question')
            ->where('question.poll = :poll')
            ->setParameter('poll', $poll);

        if (! is_null($question)) {
            $qb->andWhere('po.question = :question')
                ->setParameter('question', $question);
        }

        return $qb->getQuery()->getResult();
    }
}
