<?php

namespace Progrupa\PollBundle\Model;

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
}
