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
 * @version 4.0.0
 */

namespace Tmdb\Tests\Model;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Client;
use Tmdb\Event\HydrationEvent;
use Tmdb\Event\Listener\HydrationListener;
use Tmdb\Factory\ImageFactory;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Image;

class ImageTest extends TestCase
{
    /**
     * @var Images
     */
    private $collection;

    private $images = [
        [
            'file_path' => '/abc.jpg',
            'width' => 1000,
            'height' => 750,
            'iso_639_1' => 'en',
            'aspect_ratio' => 0.75,
            'vote_average' => 2.25,
            'vote_count' => 25
        ],
    ];

    public function setUp(): void
    {
        $ed = new EventDispatcher();
        $ed->addListener(HydrationEvent::class, new HydrationListener($ed));

        $client = new Client(
            [
                'api_token' => new ApiToken('abcdef'),
                'event_dispatcher' => ['adapter' => $ed]
            ]
        );
        $this->collection = new Images();

        foreach ($this->images as $image) {
            $factory = new ImageFactory($client->getHttpClient());
            $object = $factory->create($image);

            $this->collection->addImage($object);
        }
    }

    /**
     * @test
     */
    public function shouldGetAndSet()
    {
        $this->assertEquals(count($this->images), count($this->collection->getImages()));

        /**
         * @var Image $subject
         */
        $results = $this->collection->toArray();
        $subject = array_pop($results);

        $this->assertEquals('/abc.jpg', $subject->getFilePath());
        $this->assertEquals(1000, $subject->getWidth());
        $this->assertEquals(750, $subject->getHeight());
        $this->assertEquals('en', $subject->getIso6391());
        $this->assertEquals(0.75, $subject->getAspectRatio());
        $this->assertEquals(2.25, $subject->getVoteAverage());
        $this->assertEquals(25, $subject->getVoteCount());
    }

    /**
     * @test
     */
    public function shouldReturnCorrectTypes()
    {
        $this->assertEquals('poster', Image::getTypeFromCollectionName('posters'));
        $this->assertEquals('backdrop', Image::getTypeFromCollectionName('backdrops'));
        $this->assertEquals('profile', Image::getTypeFromCollectionName('profiles'));
        $this->assertEquals('logo', Image::getTypeFromCollectionName('logos'));
        $this->assertEquals('still', Image::getTypeFromCollectionName('stills'));
        $this->assertEquals(null, Image::getTypeFromCollectionName('sheeps'));
    }
}
