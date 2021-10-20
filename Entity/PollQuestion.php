<?php

namespace Progrupa\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="poll_questions")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *      OpenQuestion::DISCR = "OpenQuestion",
 *      ClosedQuestion::DISCR = "ClosedQuestion",
 *      YesNoQuestion::DISCR = "YesNoQuestion"
 *     })
 */
abstract class PollQuestion
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Progrupa\PollBundle\Entity\Poll", inversedBy="questions")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $poll;
    /**
     * @ORM\Column(type="text")
     */
    private $name;
    /**
     * @ORM\Column(type="text")
     */
    private $label;
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $required = true;
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $includeInOverall = true;
    /**
     * @ORM\OneToMany(targetEntity="Progrupa\PollBundle\Entity\PollAnswer", mappedBy="question")
     */
    private $answers;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $section;
    /**
     * @var integer
     * @ORM\Column(name="position", type="integer", nullable=false, options={"default":0})
     */
    private $position = 0;

    /**
     * @return string Class name of the answer
     * @throws \Exception
     */
    public static function answerClass()
    {
        throw new \Exception('PLZ implement this method in question class');
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return PollQuestion
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
     * Set label
     *
     * @param string $label
     *
     * @return PollQuestion
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
     * Set includeInOverall
     *
     * @param boolean $includeInOverall
     *
     * @return PollQuestion
     */
    public function setIncludeInOverall($includeInOverall)
    {
        $this->includeInOverall = $includeInOverall;

        return $this;
    }

    /**
     * Get includeInOverall
     *
     * @return boolean
     */
    public function getIncludeInOverall()
    {
        return $this->includeInOverall;
    }

    /**
     * Set poll
     *
     * @param \Progrupa\PollBundle\Entity\Poll $poll
     *
     * @return PollQuestion
     */
    public function setPoll(\Progrupa\PollBundle\Entity\Poll $poll = null)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return \Progrupa\PollBundle\Entity\Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Set required
     *
     * @param boolean $required
     *
     * @return PollQuestion
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answer
     *
     * @param \Progrupa\PollBundle\Entity\PollAnswer $answer
     *
     * @return PollQuestion
     */
    public function addAnswer(\Progrupa\PollBundle\Entity\PollAnswer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Progrupa\PollBundle\Entity\PollAnswer $answer
     */
    public function removeAnswer(\Progrupa\PollBundle\Entity\PollAnswer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @return mixed
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param mixed $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    abstract function getType();

    /**
     * @return $this
     */
    public function __clone()
    {
        $this->id = null;
        $this->poll = null;
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();

        return $this;
    }
}
