<?php

namespace Progrupa\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Progrupa\PollBundle\Repository\PollAnswerRepository")
 * @ORM\Table(name="poll_answers")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *      OpenQuestion::DISCR = "OpenAnswer",
 *      ClosedQuestion::DISCR = "ClosedAnswer",
 *      YesNoQuestion::DISCR = "YesNoAnswer",
 *      BusinessProfileQuestion::DISCR = "BusinessProfileAnswer"
 *     })
 */
abstract class PollAnswer
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Progrupa\PollBundle\Model\PollQuestion", inversedBy="answers")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $question;
    /**
     * @ORM\Column(name="answer_key", type="string", length=40)
     */
    private $answerKey;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set answerKey
     *
     * @param string $answerKey
     *
     * @return PollAnswer
     */
    public function setAnswerKey($answerKey)
    {
        $this->answerKey = $answerKey;

        return $this;
    }

    /**
     * Get answerKey
     *
     * @return string
     */
    public function getAnswerKey()
    {
        return $this->answerKey;
    }

    /**
     * Set question
     *
     * @param \Progrupa\PollBundle\Model\PollQuestion $question
     *
     * @return PollAnswer
     */
    public function setQuestion(\Progrupa\PollBundle\Model\PollQuestion $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Progrupa\PollBundle\Model\PollQuestion
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
