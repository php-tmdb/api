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
namespace Tmdb\Tests\Factory;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $factory;

    protected function loadByFile($file)
    {
        $class   = $this->getFactoryClass();
        $factory = new $class();

        //$data = json_decode(file_get_contents($file));
        $data = array();

        return $factory->create($data);
    }

    abstract protected function getFactoryClass();
}
