<?php

/*
 * This file is part of the Indigo Doctrine Extension package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Doctrine\Behavior;

/**
 * Use this trait to implement sluggable behavior on entities
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Slug
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    private $slug;

    /**
     * Returns the slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug
     *
     * @param string $slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
