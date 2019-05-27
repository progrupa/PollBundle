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
     * Constructor
     */
    public function __construct($options = null)
    {
        if ($options instanceof PollOption) {
            $options = new ArrayCollection([$options]);
        }

        $this->options = $options instanceof Collection ? $options : new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add option
     *
     * @param PollOption $option
     *
     * @return ClosedAnswer
     */
    public function addOption(PollOption $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * Remove option
     *
     * @param PollOption $option
     */
    public function removeOption(PollOption $option)
    {
        $this->options->removeElement($option);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptions()
    {
        return $this->options;
    }
}
