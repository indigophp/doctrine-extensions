<?php

/*
 * This file is part of the Indigo Doctrine Extension package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Dummy Entity
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class DummyEntity
{
	/**
	 * Fields
	 */
	use \Indigo\Doctrine\Field\Id;
	use \Indigo\Doctrine\Field\Name;
	use \Indigo\Doctrine\Field\Description;

	/**
	 * Behaviors
	 */
	use \Indigo\Doctrine\Behavior\SoftDelete;
	use \Indigo\Doctrine\Behavior\Slug;
	use \Indigo\Doctrine\Behavior\Tree;

	public function __construct()
	{
		$this->initTree();
	}
}
