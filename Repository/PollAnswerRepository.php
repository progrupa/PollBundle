<?php

namespace Progrupa\PollBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Progrupa\PollBundle\Entity\Poll;
use Progrupa\PollBundle\Entity\PollAnswer;

class PollAnswerRepository extends EntityRepository
{
    /**
     * @param Poll|null $poll
     * @param null $keys
     * @return array|PollAnswer[]
     */
    public function getAnswers(Poll $poll = null, $keys = null)
    {
        $qb = $this->createQueryBuilder('poll_answer')
            ->select('poll_answer')
            ->orderBy('poll_answer.id', 'DESC')
            ;

        if ($poll) {
            $qb->join('poll_answer.question', 'question')
                ->andWhere('question.poll = :poll')
                ->setParameter('poll', $poll)
                ;
        }

        if ($keys) {
            $qb->andWhere('poll_answer.answerKey IN (:keys)')
                ->setParameter('keys', is_array($keys) ? $keys : [$keys])
                ;
        }

        return $qb->getQuery()->getResult();
    }
}
