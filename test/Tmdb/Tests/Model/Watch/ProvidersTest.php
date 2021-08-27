<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Neil Daniels <neil.here@gmail.com>
 * @copyright (c) 2021, Neil Daniels
 * @version 4.0.0
 */

namespace Tmdb\Tests\Model\Watch;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Model\Watch\Providers;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Tests\Model\TestCase;

class ProvidersTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $flatrateCollection = new GenericCollection();
        $rentCollection = new GenericCollection();
        $buyCollection = new GenericCollection();
        
        $data = [
            'iso_3166_1' => 'US',
            'link' => 'https://www.themoviedb.org/movie/12092-alice-in-wonderland/watch?locale=US',
            'flatrate' => $flatrateCollection,
            'rent' => $rentCollection,
            'buy' => $buyCollection,
        ];

        $hydrator = new ObjectHydrator();

        /**
         * @var Release $object
         */
        $object = $hydrator->hydrate(new Providers(), $data);

        $this->assertEquals('US', $object->getIso31661());
        $this->assertEquals('https://www.themoviedb.org/movie/12092-alice-in-wonderland/watch?locale=US', $object->getLink());
        $this->assertEquals($flatrateCollection, $object->getFlatrate());
        $this->assertEquals($rentCollection, $object->getRent());
        $this->assertEquals($buyCollection, $object->getBuy());
    }
}
