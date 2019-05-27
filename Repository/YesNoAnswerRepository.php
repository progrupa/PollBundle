<?php

namespace Progrupa\PollBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Progrupa\PollBundle\Interfaces\AnswerRepository;
use Progrupa\PollBundle\Entity\PollQuestion;

class YesNoAnswerRepository extends EntityRepository implements AnswerRepository
{
    public function getResultsForQuestion(PollQuestion $question)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a.yesNo, COUNT(a) as cnt')
            ->where('a.question = :question')
            ->setParameter('question', $question)
            ->groupBy('a.yesNo')
        ;

        $result = $qb->getQuery()->getArrayResult();
        $total = 0;
        $out = [];
        foreach ($result as $item) {
            $total += $item['cnt'];
            $out[$item['yesNo']] = $item['cnt'];
        }

        return [$total, $out];
    }
}
