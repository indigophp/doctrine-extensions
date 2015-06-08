<?php

/*
 * This file is part of the Indigo Doctrine Extension package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Doctrine\Behavior\EAV;

use Doctrine\ORM\Mapping as ORM;

/**
 * Use this trait to implement Data part of EAV behavior on entities
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Data
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $value;

    /**
     * @var object
     */
    private $entity;

    /**
     * Returns the key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Returns the value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Creates a new object with a key
     *
     * @param string $key
     *
     * @return self
     */
    public static function create($key)
    {
        $new = new self;
        $new->key = $key;

        return $new;
    }
}
