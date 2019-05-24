<?php

namespace Progrupa\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ClosedQuestion extends PollQuestion
{
    const DISCR = 'closed';

    /**
     * @ORM\OneToMany(targetEntity="Progrupa\PollBundle\Model\PollOption", mappedBy="question")
     */
    private $options;
    /**
     * @ORM\Column(type="boolean")
     */
    private $multiple;
    /**
     * @ORM\Column(type="boolean")
     */
    private $expanded;

    public static function answerClass()
    {
        return ClosedAnswer::class;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set multiple
     *
     * @param boolean $multiple
     *
     * @return ClosedQuestion
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Get multiple
     *
     * @return boolean
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * Set expanded
     *
     * @param boolean $expanded
     *
     * @return ClosedQuestion
     */
    public function setExpanded($expanded)
    {
        $this->expanded = $expanded;

        return $this;
    }

    /**
     * Get expanded
     *
     * @return boolean
     */
    public function getExpanded()
    {
        return $this->expanded;
    }

    /**
     * Add option
     *
     * @param \Progrupa\PollBundle\Model\PollOption $option
     *
     * @return ClosedQuestion
     */
    public function addOption(\Progrupa\PollBundle\Model\PollOption $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * Remove option
     *
     * @param \Progrupa\PollBundle\Model\PollOption $option
     */
    public function removeOption(\Progrupa\PollBundle\Model\PollOption $option)
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
