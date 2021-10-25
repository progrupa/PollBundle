<?php

namespace Progrupa\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="poll_closer_answer_options")
 */
class ClosedAnswerOption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ClosedAnswer
     *
     * @ORM\ManyToOne(targetEntity="ClosedAnswer", inversedBy="answerOptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     * })
     */
    private $answer;

    /**
     * @var PollOption
     *
     * @ORM\ManyToOne(targetEntity="PollOption", inversedBy="optionAnswers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="option_id", referencedColumnName="id")
     * })
     */
    private $option;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $openText;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ClosedAnswer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param ClosedAnswer $answer
     */
    public function setAnswer(ClosedAnswer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return PollOption
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param PollOption $option
     */
    public function setOption(PollOption $option)
    {
        $this->option = $option;
    }

    /**
     * @return string
     */
    public function getOpenText()
    {
        return $this->openText;
    }

    /**
     * @param string $openText
     */
    public function setOpenText($openText)
    {
        $this->openText = $openText;
    }
}
