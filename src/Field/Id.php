<?php

/*
 * This file is part of the Indigo Doctrine Extension package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Doctrine\Field;

/**
 * Use this trait to implement ID field on entities
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Id
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Returns the ID
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
