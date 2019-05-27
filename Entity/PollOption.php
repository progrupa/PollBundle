<?php

namespace Progrupa\PollBundle\Entity;

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
     * @ORM\Column(type="text")
     */
    private $label;
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $value;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->poll = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set question
     *
     * @param \Progrupa\PollBundle\Entity\ClosedQuestion $question
     *
     * @return PollOption
     */
    public function setQuestion(\Progrupa\PollBundle\Entity\ClosedQuestion $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Progrupa\PollBundle\Entity\ClosedQuestion
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
