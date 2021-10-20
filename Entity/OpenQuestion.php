<?php

namespace Progrupa\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class OpenQuestion extends PollQuestion
{
    const DISCR = 'open';

    public static function answerClass()
    {
        return OpenAnswer::class;
    }

    public function getType()
    {
        return $this::DISCR;
    }
}
