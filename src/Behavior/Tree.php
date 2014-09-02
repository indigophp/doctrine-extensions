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
     * Returns the right
     *
     * @return integer
     */
    public function getRight()
    {
        return $this->right;
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
     * Returns the root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
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
