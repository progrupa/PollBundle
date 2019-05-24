<?php

namespace Progrupa\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Progrupa\PollBundle\Repository\YesNoAnswerRepository")
 */
class YesNoAnswer extends PollAnswer
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $yesNo;

    /**
     * YesNoAnswer constructor.
     * @param $yesNo
     */
    public function __construct($yesNo)
    {
        $this->yesNo = $yesNo;
    }

    /**
     * Set yesNo
     *
     * @param boolean $yesNo
     *
     * @return YesNoAnswer
     */
    public function setYesNo($yesNo)
    {
        $this->yesNo = $yesNo;

        return $this;
    }

    /**
     * Get yesNo
     *
     * @return boolean
     */
    public function getYesNo()
    {
        return $this->yesNo;
    }
}
