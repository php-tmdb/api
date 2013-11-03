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
namespace Tmdb\Model\Common;

use Guzzle\Common\Collection as GuzzleCollection;

class Collection extends GuzzleCollection {
    protected $data = array();

    /**
     * Allow adding objects to the collection
     *
     * @param $object
     */
    public function addObject($object)
    {
        if (!is_object($object)) {
            return;
        }

        $this->add(null, $object);
    }

    /**
     * Allow support for adding objects
     *
     * @param string $key
     * @param mixed $value
     * @return GuzzleCollection
     */
    public function add($key, $value) {
        if ($key === null && is_object($value)) {
            $key = spl_object_hash($value);
        }

        return parent::add($key, $value);
    }

    /**
     * Allow support for getting objects
     *
     * @param string $key
     * @return mixed|null
     */
    public function get($key) {
        if (is_object($key)) {
            $key = spl_object_hash($key);
        }

        return parent::get($key);
    }
} 