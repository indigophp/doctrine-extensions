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

use Indigo\Doctrine\Entity\Author as AuthorEntity;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Author
{
    /**
     * @var AuthorEntity
     */
    private $author;

    /**
     * {@inheritdoc}
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthor(AuthorEntity $author)
    {
        $this->author = $author;
    }
}
