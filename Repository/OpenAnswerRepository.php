<?php

namespace Progrupa\PollBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Progrupa\PollBundle\Interfaces\AnswerRepository;
use Progrupa\PollBundle\Model\PollQuestion;

class OpenAnswerRepository extends EntityRepository implements AnswerRepository
{
    public function getResultsForQuestion(PollQuestion $question)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a.openText')
            ->where('a.question = :question')
            ->andWhere('a.openText IS NOT NULL')
            ->setParameter('question', $question)
        ;

        $result = $qb->getQuery()->getArrayResult();
        $out = [];
        foreach ($result as $item) {
            $out[] = $item['openText'];
        }

        return [count($out), $out];
    }
}
