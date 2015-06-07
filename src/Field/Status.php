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
 * Use this trait to implement enabled/disabled Status field on entities
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Status
{
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * Returns the status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Returns status
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->status;
    }

    /**
     * Sets the status to enabled
     */
    public function enable()
    {
        $this->status = true;
    }

    /**
     * Sets the status to disabled
     */
    public function disable()
    {
        $this->status = false;
    }
}
