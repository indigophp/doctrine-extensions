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

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Use this trait to implement tree behavior on entities
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Tree
{
    /**
     * @var integer
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(name="tree_left", type="integer")
     */
    private $left;

    /**
     * @var integer
     *
     * @Gedmo\TreeRight
     * @ORM\Column(name="tree_right", type="integer")
     */
    private $right;

    /**
     * @var integer
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(name="tree_level", type="integer")
     */
    private $level;

    /**
     * @var integer
     *
     * @Gedmo\TreeRoot
     * @ORM\Column(name="tree_root", type="integer")
     */
    private $root;

    /**
     * @var self
     */
    private $parent;

    /**
     * @var Collection
     */
    private $children;

    /**
     * Initialize tree behavior
     *
     * NOTE: Should be invoked in __construct
     */
    protected function initTree()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * Returns the left
     *
     * @return integer
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Sets the left
     *
     * @param integer $left
     *
     * @return self
     */
    public function setLeft($left)
    {
        $this->left = $left;

        return $this;
    }

    /**
     * Returns the right
     *
     * @return integer
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Sets the right
     *
     * @param integer $right
     *
     * @return self
     */
    public function setRight($right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * Returns the level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Sets the level
     *
     * @param integer $level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Returns the parent
     *
     * @return self
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent
     *
     * @param self $parent
     *
     * @return self
     */
    public function setParent(self $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Returns children
     *
     * @return Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Checks whether current entity has a child
     *
     * @param self $child
     *
     * @return boolean
     */
    public function hasChild(self $child)
    {
        return $this->children->contains($child);
    }

    /**
     * Adds a child
     *
     * @param self $child
     *
     * @return self
     */
    public function addChild(self $child)
    {
        if (!$this->hasChild($child))
        {
            $child->setParent($this);

            $this->children[] = $child;
        }

        return $this;
    }

    /**
     * Removes a child
     *
     * @param self $child
     */
    public function removeChild(self $child)
    {
        if ($this->hasChild($child))
        {
            $child->setParent(null);
            $this->children->removeElement($child);
        }
    }

    /**
     * Checks whether this element is a root
     *
     * @return boolean
     */
    public function isRoot()
    {
        return $this->parent === null;
    }
}
