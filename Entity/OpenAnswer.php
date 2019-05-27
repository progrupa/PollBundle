<?php

namespace Progrupa\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Progrupa\PollBundle\Repository\OpenAnswerRepository")
 */
class OpenAnswer extends PollAnswer
{
    /**
     * @ORM\Column(type="text")
     */
    private $openText;

    /**
     * OpenAnswer constructor.
     * @param $openText
     */
    public function __construct($openText = '')
    {
        $this->openText = $openText;
    }

    /**
     * Set openText
     *
     * @param string $openText
     *
     * @return OpenAnswer
     */
    public function setOpenText($openText)
    {
        $this->openText = $openText;

        return $this;
    }

    /**
     * Get openText
     *
     * @return string
     */
    public function getOpenText()
    {
        return $this->openText;
    }
}
