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

abstract class AbstractFactory {
    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @return $this
     */
    abstract public static function create(array $data = array());

    /**
     * Convert an array with an collection of items to an hydrated object collection
     *
     * @param array $data
     * @return $this
     */
    abstract public static function createCollection(array $data = array());
}