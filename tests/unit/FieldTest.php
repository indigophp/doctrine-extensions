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

use Codeception\TestCase\Test;

/**
 * Tests for Fields
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @group Doctrine
 */
class FieldTest extends Test
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
     * @covers Indigo\Doctrine\Field\Id::getId
     */
    public function testId()
    {
        $this->assertNull($this->entity->getId());
    }

    /**
     * @covers Indigo\Doctrine\Field\Name::getName
     * @covers Indigo\Doctrine\Field\Name::setName
     */
    public function testName()
    {
        $this->assertSame($this->entity, $this->entity->setName('test'));
        $this->assertEquals('test', $this->entity->getName());
    }

    /**
     * @covers Indigo\Doctrine\Field\Description::getDescription
     * @covers Indigo\Doctrine\Field\Description::setDescription
     */
    public function testDescription()
    {
        $this->assertSame($this->entity, $this->entity->setDescription('test'));
        $this->assertEquals('test', $this->entity->getDescription());
    }
}
