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
 * DateTime Timestamps
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait DateTime
{
    use Timestamp;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * {@inheritdoc}
     */
    protected function initCreatedAt()
    {
        $this->createdAt = new \DateTime;
    }

    /**
     * {@inheritdoc}
     */
    protected function assertValidTimestamp($timestamp)
    {
        if (!$timestamp instanceof \DateTime) {
            throw new \InvalidArgumentException('Timestamp should be a DateTime instance');
        }
    }
}
