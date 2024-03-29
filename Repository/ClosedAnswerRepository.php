<?php

namespace Progrupa\PollBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Progrupa\PollBundle\Interfaces\AnswerRepository;
use Progrupa\PollBundle\Entity\PollQuestion;

class ClosedAnswerRepository extends EntityRepository implements AnswerRepository
{
    public function getResultsForQuestion(PollQuestion $question)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('COUNT(a.id) as cnt, option.id as optionId')
            ->join('a.answerOptions', 'answerOptions')
            ->join('answerOptions.option', 'option')
            ->where('a.question = :question')
            ->setParameter('question', $question)
            ->groupBy('option.id')
        ;

        $result = $qb->getQuery()->getArrayResult();
        $out = [];
        foreach ($result as $item) {
            $out[$item['optionId']] = $item['cnt'];
        }

        $qb = $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->where('a.question = :question')
            ->setParameter('question', $question)
        ;

        $total = $qb->getQuery()->getSingleScalarResult();

        return [$total, $out];
    }
}
