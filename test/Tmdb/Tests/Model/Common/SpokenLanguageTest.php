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
namespace Tmdb\Tests\Model\Common;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Common\SpokenLanguage;
use Tmdb\Tests\Model\TestCase;

class SpokenLanguageTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'iso_639_1' => 'en',
            'name'      => 'English'
        ];

        $hydrator = new ObjectHydrator();

        $object = $hydrator->hydrate(new SpokenLanguage(), $data);

        /**
         * @var SpokenLanguage $object
         */
        //$this->assertEquals('en', $object->getIso6391());
        $this->assertEquals('English', $object->getName());
    }
}
