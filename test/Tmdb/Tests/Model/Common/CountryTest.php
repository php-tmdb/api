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
use Tmdb\Model\Common\Country;
use Tmdb\Tests\Model\TestCase;

class CountryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $data = [
            'iso_3166_1' => 'US',
            'name'       => 'United States of America'
        ];

        $hydrator = new ObjectHydrator();

        $object = $hydrator->hydrate(new Country(), $data);

        $this->assertEquals('US', $object->getIso31661());
        $this->assertEquals('United States of America', $object->getName());
    }
}
