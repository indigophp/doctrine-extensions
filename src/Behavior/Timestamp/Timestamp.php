<?php

/*
 * This file is part of the Indigo Doctrine Extension package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Doctrine\Behavior\Timestamp;

/**
 * "Abstract" Timestamps
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Timestamp
{
    /**
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * Returns creation time
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets creation time
     *
     * @param integer $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->assertValidTimestamp($createdAt);

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns last updated time
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Sets last updated time
     *
     * @param integer $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->assertValidTimestamp($updatedAt);

        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Sets initial creation time
     */
    abstract protected function initCreatedAt();

    /**
     * Asserts that a timestamp is valid
     *
     * @param mixed $timestamp
     *
     * @throws InvalidArgumentException If $timestamp is not valid
     */
    abstract protected function assertValidTimestamp($timestamp);
}
