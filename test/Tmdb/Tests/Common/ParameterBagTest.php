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
class ParameterBagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function canResolveArrayAsValue()
    {
        $array = [1,2,3,4];
        $bag   = new \Tmdb\Common\ParameterBag([
            'test' => $array
        ]);

        $this->assertEquals($bag->get('test'), $array);
    }
}
