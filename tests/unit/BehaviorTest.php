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

use Codeception\TestCase\Test;

/**
 * Tests for Behaviors
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @group Doctrine
 */
class BehaviorTest extends Test
{
	/**
	 * Dummy Entity object
	 *
	 * @var DummyEntity
	 */
	protected $entity;

	public function _before()
	{
		$this->entity = new \DummyEntity;
	}

	/**
	 * @covers Indigo\Doctrine\Behavior\Slug::getSlug
	 * @covers Indigo\Doctrine\Behavior\Slug::setSlug
	 */
	public function testSlug()
	{
		$this->assertSame($this->entity, $this->entity->setSlug('test'));
		$this->assertEquals('test', $this->entity->getSlug());
	}

	/**
	 * @covers Indigo\Doctrine\Behavior\SoftDelete::getDeletedAt
	 * @covers Indigo\Doctrine\Behavior\SoftDelete::setDeletedAt
	 */
	public function testSoftDelete()
	{
		$date = new \DateTime();

		$this->assertSame($this->entity, $this->entity->setDeletedAt($date));
		$this->assertEquals($date, $this->entity->getDeletedAt());
	}

	/**
	 * @covers Indigo\Doctrine\Behavior\Tree::getLeft
	 * @covers Indigo\Doctrine\Behavior\Tree::getRight
	 * @covers Indigo\Doctrine\Behavior\Tree::getLevel
	 * @covers Indigo\Doctrine\Behavior\Tree::getRoot
	 * @covers Indigo\Doctrine\Behavior\Tree::getParent
	 * @covers Indigo\Doctrine\Behavior\Tree::setParent
	 * @covers Indigo\Doctrine\Behavior\Tree::getChildren
	 * @covers Indigo\Doctrine\Behavior\Tree::addChild
	 * @covers Indigo\Doctrine\Behavior\Tree::hasChild
	 * @covers Indigo\Doctrine\Behavior\Tree::removeChild
	 * @covers Indigo\Doctrine\Behavior\Tree::isRoot
	 * @covers Indigo\Doctrine\Behavior\Tree::initTree
	 */
	public function testTree()
	{
		$parent = new \DummyEntity;
		$child = new \DummyEntity;

		$this->assertNull($this->entity->getLeft());
		$this->assertNull($this->entity->getRight());
		$this->assertNull($this->entity->getLevel());
		$this->assertNull($this->entity->getRoot());
		$this->assertSame($this->entity, $this->entity->setParent($parent));
		$this->assertSame($parent, $this->entity->getParent());
		$this->assertSame($this->entity, $this->entity->addChild($child));
		$this->assertInstanceOf('Doctrine\\Common\\Collections\\ArrayCollection', $this->entity->getChildren());
		$this->assertTrue($this->entity->hasChild($child));
		$this->assertFalse($parent->hasChild($this->entity));
		$this->assertSame($this->entity, $child->getParent());
		$this->assertNull($this->entity->removeChild($child));
		$this->assertFalse($this->entity->hasChild($child));
		$this->assertTrue($parent->isRoot());
		$this->assertFalse($this->entity->isRoot());
	}
}
