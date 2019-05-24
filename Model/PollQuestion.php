<?php

namespace Progrupa\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="poll_questions")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *      OpenQuestion::DISCR = "OpenQuestion",
 *      ClosedQuestion::DISCR = "ClosedQuestion",
 *      YesNoQuestion::DISCR = "YesNoQuestion",
 *      BusinessProfileQuestion::DISCR = "BusinessProfileQuestion"
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
     * @ORM\ManyToOne(targetEntity="Progrupa\PollBundle\Model\Poll", inversedBy="questions")
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
     * @ORM\OneToMany(targetEntity="Progrupa\PollBundle\Model\PollAnswer", mappedBy="question")
     */
    private $answers;

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
     * @param \Progrupa\PollBundle\Model\Poll $poll
     *
     * @return PollQuestion
     */
    public function setPoll(\Progrupa\PollBundle\Model\Poll $poll = null)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return \Progrupa\PollBundle\Model\Poll
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
     * @param \Progrupa\PollBundle\Model\PollAnswer $answer
     *
     * @return PollQuestion
     */
    public function addAnswer(\Progrupa\PollBundle\Model\PollAnswer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Progrupa\PollBundle\Model\PollAnswer $answer
     */
    public function removeAnswer(\Progrupa\PollBundle\Model\PollAnswer $answer)
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
}
