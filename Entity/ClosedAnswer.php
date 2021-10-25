<?php

namespace Progrupa\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Progrupa\PollBundle\Repository\ClosedAnswerRepository")
 */
class ClosedAnswer extends PollAnswer
{
    /**
     * @ORM\ManyToMany(targetEntity="Progrupa\PollBundle\Entity\PollOption")
     * @ORM\JoinTable(name="poll_answer_poll_options",
     *     joinColumns={@ORM\JoinColumn(onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     *     )
     */
    private $options;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="ClosedAnswerOption", mappedBy="answer", cascade={"persist", "remove"})
     */
    private $answerOptions;

    /**
     * Constructor
     */
    public function __construct($options = null)
    {
        if ($options instanceof PollOption) {
            //$options = new ArrayCollection([$options]);
        }

        //$this->options = $options instanceof Collection ? $options : new \Doctrine\Common\Collections\ArrayCollection();

        $this->answerOptions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptionsOld()
    {
        return $this->options;
    }

    /**
     *
     * @param ClosedAnswerOption $option
     * @return ClosedAnswer
     */
    public function addAnswerOption(ClosedAnswerOption $option)
    {
        $this->answerOptions[] = $option;

        return $this;
    }

    /**
     *
     * @param ClosedAnswerOption $option
     */
    public function removeAnswerOption(ClosedAnswerOption $option)
    {
        $this->answerOptions->removeElement($option);
    }

    /**
     * @return Collection
     */
    public function getAnswerOptions()
    {
        return $this->answerOptions;
    }

}
