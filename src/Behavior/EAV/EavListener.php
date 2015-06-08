<?php

/*
 * This file is part of the Indigo Doctrine Extension package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Doctrine\Behavior\EAV;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Event\OnClassMetadataNotFoundEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;

/**
 * Use this listener to automatically populate associations
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class EavListener implements EventSubscriber
{
    /**
     * Array of EAV Entities
     *
     * @var array
     */
    private $classes = [];

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata];
    }

    /**
     * Adds an entity
     *
     * @param string $entityClass
     * @param string $dataClass
     */
    public function addEavEntity($entityClass, $dataClass)
    {
        $this->classes[$entityClass] = $dataClass;
    }

    /**
     * Processes event and resolves new target entity names.
     *
     * @param LoadClassMetadataEventArgs $args
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $cm = $args->getClassMetadata();

        if (isset($this->classes[$cm->name])) {
            $mapping = [
                'targetEntity'  => $this->classes[$cm->name],
                'fieldName'     => 'data',
                'mappedBy'      => 'entity',
                'cascade'       => ['persist', 'remove'],
                'orphanRemoval' => true,
            ];

            $cm->mapOneToMany($mapping);
        } elseif (in_array($cm->name, $this->classes)) {
            $mapping = [
                'targetEntity' => array_search($cm->name, $this->classes),
                'fieldName'    => 'entity',
                'inversedBy'   => 'data',
            ];

            $cm->mapManyToOne($mapping);

            $cm->table['uniqueConstraints']['eav_data_idx'] = [
                'columns' => ['entity_id', 'key'],
            ];
        }
    }
}
