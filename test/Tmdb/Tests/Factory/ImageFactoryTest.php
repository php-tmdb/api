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

use Tmdb\Model\Collection\Images;
use Tmdb\Model\Image;

class ImageFactoryTest extends TestCase
{
    /**
     * @var Images
     */
    private $images;

    public function setUp()
    {
        $factory   = $this->getFactory();

        $movieData     = $this->loadByFile('images/movie.json');
        $tvData        = $this->loadByFile('images/tv.json');
        $tvSeasonData  = $this->loadByFile('images/tv_season.json');
        $tvEpisodeData = $this->loadByFile('images/tv_episode.json');
        $personData    = $this->loadByFile('images/person.json');

        $data = array_merge([], [$movieData, $tvData, $tvSeasonData, $tvEpisodeData, $personData]);

        $this->images = $factory->createImageCollection($data);
    }

    /**
     * @test
     */
    public function shouldBeAbleToCreateCollection()
    {
        $factory = $this->getFactory();

        $data = [
            ['id' => 1],
            ['id' => 2],
        ];

        $collection = $factory->createCollection($data);

        $this->assertEquals(2, count($collection));
    }

    /**
     * @test
     */
    public function shouldFilterPosters()
    {
        $collection = $this->getFactory()->createImageCollection($this->loadByFile('images/movie.json'));

        $posters = $collection->filterPosters();

        foreach ($posters as $poster) {
            $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $poster);
        }
    }

    /**
     * @test
     */
    public function shouldFilterBackdrops()
    {
        $collection = $this->getFactory()->createImageCollection($this->loadByFile('images/movie.json'));

        $backdrops = $collection->filterBackdrops();

        foreach ($backdrops as $backdrop) {
            $this->assertInstanceOf('Tmdb\Model\Image\BackdropImage', $backdrop);
        }
    }

    /**
     * @test
     */
    public function shouldFilterProfiles()
    {
        $collection = $this->getFactory()->createImageCollection($this->loadByFile('images/person.json'));

        $profiles = $collection->filterProfile();

        foreach ($profiles as $profile) {
            $this->assertInstanceOf('Tmdb\Model\Image\ProfileImage', $profile);
        }
    }

    /**
     * @test
     */
    public function shouldFilterStills()
    {
        $collection = $this->getFactory()->createImageCollection($this->loadByFile('images/tv_episode.json'));

        $stills = $collection->filterStills();

        foreach ($stills as $still) {
            $this->assertInstanceOf('Tmdb\Model\Image\StillImage', $still);
        }
    }

    /**
     * @test
     */
    public function shouldFilterMinHeight()
    {
        $this->setUp();

        $images = $this->images->filterMinHeight(1000);

        $this->assertEquals(false, empty($images));

        /**
         * @var Image $image
         */
        foreach ($images as $image) {
            $this->assertEquals(true, $image->getHeight() >= 1000);
        }
    }

    /**
     * @test
     */
    public function shouldFilterMinWidth()
    {
        $this->setUp();

        $images = $this->images->filterMinWidth(1000);

        $this->assertEquals(false, empty($images));

        /**
         * @var Image $image
         */
        foreach ($images as $image) {
            $this->assertEquals(true, $image->getWidth() >= 1000);
        }
    }

    /**
     * @test
     */
    public function shouldFilterMaxHeight()
    {
        $this->setUp();

        $images = $this->images->filterMaxHeight(1000);

        $this->assertEquals(false, empty($images));

        /**
         * @var Image $image
         */
        foreach ($images as $image) {
            $this->assertEquals(true, $image->getHeight() <= 1000);
        }
    }

    /**
     * @test
     */
    public function shouldFilterMaxWidth()
    {
        $this->setUp();

        $images = $this->images->filterMaxWidth(1000);

        $this->assertEquals(false, empty($images));

        /**
         * @var Image $image
         */
        foreach ($images as $image) {
            $this->assertEquals(true, $image->getWidth() <= 1000);
        }
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\ImageFactory';
    }
}
