<?php
/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @author Benny <benny@whitewashing.de> ( borrowed array object extension )
 * @copyright (c) 2013, Michael Roterman
 * @version 0.0.1
 */

namespace Tmdb\Common;

class ParameterBag extends \ArrayObject
{
    public function __construct($array = [], $flags = 0, $iterator_class = "ArrayIterator")
    {
        $objects = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $objects[$key] = new self($value, $flags, $iterator_class);
            } else {
                $objects[$key] = $value;
            }
        }

        parent::__construct($objects, $flags, $iterator_class);
    }

    /**
     * Override the parent to transform submitted arrays into a ParameterBag
     *
     * @param mixed $name
     * @param mixed $value
     */
    public function offsetSet($name, $value)
    {
        if (is_array($value)) {
            $value = new self($value);
        }

        return parent::offsetSet($name, $value);
    }

    /**
     * Setter
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->offsetSet($name, $value);

        return $this;
    }

    /**
     * Getter
     *
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        return parent::offsetGet($name);
    }
}
