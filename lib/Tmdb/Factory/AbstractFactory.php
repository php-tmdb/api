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
use Tmdb\Factory\Common\GenericCollectionFactory;
use Tmdb\Model\AbstractModel;

abstract class AbstractFactory {
    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @return AbstractModel
     */
    abstract public static function create(array $data = array());

    /**
     * Convert an array with an collection of items to an hydrated object collection
     *
     * @param array $data
     * @return GenericCollectionFactory
     */
    abstract public static function createCollection(array $data = array());

    /**
     * Hydrate the object with data
     *
     * @param AbstractModel $object
     * @param array $data
     * @return AbstractModel
     */
    public function hydrate(AbstractModel $object, $data = array())
    {
        return ObjectHydrator::hydrate($object, $data);
    }
}