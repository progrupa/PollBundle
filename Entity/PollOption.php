<?php

namespace Progrupa\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Progrupa\PollBundle\Repository\PollOptionRepository")
 * @ORM\Table(name="poll_options")
 */
class PollOption
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Progrupa\PollBundle\Entity\ClosedQuestion", inversedBy="options")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $question;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="ClosedAnswerOption", mappedBy="option", cascade={"persist", "remove"})
     */
    private $optionAnswers;

    /**
     * @ORM\Column(type="text")
     */
    private $label;
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $value;
    /**
     * @ORM\Column(type="boolean")
     */
    private $open;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->poll = new ArrayCollection();
        $this->optionAnswers = new ArrayCollection();
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
     * Set label
     *
     * @param string $label
     *
     * @return PollOption
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return PollOption
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return boolean
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * @param boolean $open
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }

    /**
     * Set question
     *
     * @param ClosedQuestion $question
     *
     * @return PollOption
     */
    public function setQuestion(ClosedQuestion $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return ClosedQuestion
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     *
     * @param ClosedAnswerOption $option
     * @return ClosedAnswer
     */
    public function addAnswerOption(ClosedAnswerOption $option)
    {
        $this->optionAnswers[] = $option;

        return $this;
    }

    /**
     *
     * @param ClosedAnswerOption $option
     */
    public function removeAnswerOption(ClosedAnswerOption $option)
    {
        $this->optionAnswers->removeElement($option);
    }

    /**
     * @return Collection
     */
    public function getAnswerOptions()
    {
        return $this->optionAnswers;
    }


    /**
     * @return $this
     */
    public function __clone()
    {
        $this->id = null;
        $this->question = null;
        $this->optionAnswers = null;

        return $this;
    }
}
