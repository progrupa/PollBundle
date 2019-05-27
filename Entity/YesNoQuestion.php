<?php

namespace Progrupa\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class YesNoQuestion extends PollQuestion
{
    const DISCR = 'yesno';

    public static function answerClass()
    {
        return YesNoAnswer::class;
    }
}
