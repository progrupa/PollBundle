<?php

namespace Progrupa\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="polls")
 */
class Poll
{
    const STATE_PREPARED = 'prepared';
    const STATE_ACTIVE = 'active';
    const STATE_FINISHED = 'finished';

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $state;
    /**
     * @ORM\OneToMany(targetEntity="Progrupa\PollBundle\Model\PollQuestion", mappedBy="poll")
     */
    private $questions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Poll
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Add question
     *
     * @param \Progrupa\PollBundle\Model\PollQuestion $question
     *
     * @return Poll
     */
    public function addQuestion(\Progrupa\PollBundle\Model\PollQuestion $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \Progrupa\PollBundle\Model\PollQuestion $question
     */
    public function removeQuestion(\Progrupa\PollBundle\Model\PollQuestion $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection|PollQuestion[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
