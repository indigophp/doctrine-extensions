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

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Use this trait to implement Entity part of EAV behavior on entities
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Entity
{
    /**
     * @var Selectable
     */
    private $data;

    /**
     * Returns data for a given key (or the whole data set) or default value
     *
     * @param string|null $key
     * @param mixed|null  $default
     *
     * @return mixed
     */
    public function getData($key = null, $default = null)
    {
        if (is_null($key)) {
            $data = [];

            foreach ($this->data as $key => $value) {
                $data[$key] = $value->getValue();
            }

            return $data;
        }

        $data = $this->findData($key);

        return isset($data) ? $data->geteValue() : $default;
    }

    /**
     * Sets the value of an already existing data or creates a new one
     *
     * @param string $key
     * @param string $value
     */
    public function setData($key, $value)
    {
        $data = $this->findData($key);

        if (!isset($data)) {
            $data = $this->createData($key);
        }

        $data->setValue($value);
    }

    /**
     * Removes data if set previously
     *
     * @param string $key
     *
     * @return boolean
     */
    public function removeData($key)
    {
        $data = $this->findData($key);

        if (isset($data)) {
            $this->data->removeElement($data);
            $data->remove();

            return true;
        }

        return false;
    }

    /**
     * Finds a data entity
     *
     * @param string $key
     *
     * @return object|null
     */
    protected function findData($key)
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('key', $key));

        $result = $this->data->matching($criteria);

        if (is_array($result)) {
            $result = reset($result);

            return $result;
        }
    }

    /**
     * Creates a data object with a key
     *
     * @param string $key
     *
     * @return object
     */
    abstract protected function createData($key);
}
