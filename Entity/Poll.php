<?php

namespace Progrupa\PollBundle\Entity;

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
     *
     * @ORM\Column(name="hash", type="text", nullable=true)
     */
    private $hash;

    /**
     * @var string
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="Progrupa\PollBundle\Entity\PollQuestion", mappedBy="poll")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $questions;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false, options={"default":1})
     */
    private $anonymous = true;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="modified_at", type="datetime", nullable=true)
     */
    private $modifiedAt;

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
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function generateHash()
    {
        $now = new \DateTime();

        $this->hash = hash('ripemd128', uniqid() . $this->getName() . $now->format('Ymd_His'));

        return $this->hash;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
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
     * @param \Progrupa\PollBundle\Entity\PollQuestion $question
     *
     * @return Poll
     */
    public function addQuestion(\Progrupa\PollBundle\Entity\PollQuestion $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \Progrupa\PollBundle\Entity\PollQuestion $question
     */
    public function removeQuestion(\Progrupa\PollBundle\Entity\PollQuestion $question)
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

    /**
     * @return bool
     */
    public function isAnonymous()
    {
        return $this->anonymous;
    }

    /**
     * @param bool $anonymous
     */
    public function setAnonymous($anonymous)
    {
        $this->anonymous = $anonymous;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @param \DateTime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }
}
