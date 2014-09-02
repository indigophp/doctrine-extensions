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
 * Integer Timestamps
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Integer
{
    use Timestamp;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $updatedAt;

    /**
     * {@inheritdoc}
     */
    protected function initCreatedAt()
    {
        $this->createdAt = time();
    }

    /**
     * {@inheritdoc}
     */
    protected function assertValidTimestamp($timestamp)
    {
        if (!is_int($timestamp)) {
            throw new \InvalidArgumentException('Timestamp should be an integer');
        }
    }
}
