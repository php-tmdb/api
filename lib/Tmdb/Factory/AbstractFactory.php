<?php
/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 0.0.1
 */
namespace Tmdb\Factory;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;

abstract class AbstractFactory implements FactoryInterface {
    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @return AbstractModel
     */
    abstract public function create(array $data = array());

    /**
     * Convert an array with an collection of items to an hydrated object collection
     *
     * @param array $data
     * @return GenericCollection
     */
    abstract public function createCollection(array $data = array());

    /**
     * Create a generic collection of data and map it on the class by it's static parameter $_properties
     *
     * @param array $data
     * @param $class
     * @return GenericCollection
     */
    protected function createGenericCollection(array $data = array(), $class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $collection = new GenericCollection();

        foreach($data as $item) {
            $collection->add(null, $this->hydrate(new $class(), $item));
        }

        return $collection;
    }

    /**
     * Hydrate the object with data
     *
     * @param AbstractModel $object
     * @param array $data
     * @return AbstractModel
     */
    protected function hydrate(AbstractModel $object, $data = array())
    {
        $objectHydrator = new ObjectHydrator();

        return $objectHydrator->hydrate($object, $data);
    }
}
