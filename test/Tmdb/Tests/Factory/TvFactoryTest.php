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

use Tmdb\Factory\TvFactory;
use Tmdb\Model\Tv;

class TvFactoryTest extends TestCase
{
    /**
     * @var Tv
     */
    private $tv;

    public function setUp() :void
    {
        /**
         * @var TvFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('tv/all.json');

        $data['overview'] = 'external';

        /**
         * @var Tv $this->tv
         */
        $this->tv = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructTv()
    {


        $this->assertInstanceOf('Tmdb\Model\Tv', $this->tv);

        $this->assertInstanceOf('\DateTime', $this->tv->getLastAirDate());
        $this->assertInstanceOf('Tmdb\Model\Image\BackdropImage', $this->tv->getBackdropImage());
        $this->assertInstanceOf('Tmdb\Model\Collection\Genres', $this->tv->getGenres());
        $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $this->tv->getPosterImage());
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {


        $factory = new TvFactory($this->getHttpClient());
        $class  = new \stdClass();

        $factory->setCastFactory($class);
        $factory->setCrewFactory($class);
        $factory->setGenreFactory($class);
        $factory->setImageFactory($class);
        $factory->setTvSeasonFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getCastFactory());
        $this->assertInstanceOf('stdClass', $factory->getCrewFactory());
        $this->assertInstanceOf('stdClass', $factory->getGenreFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
        $this->assertInstanceOf('stdClass', $factory->getTvSeasonFactory());

        $model = new Tv();
        $model->setCredits($class);

        $this->assertInstanceOf('stdClass', $model->getCredits());
    }

    /**
     * @test
     * @todo see comments
     */
    public function shouldBeFunctional()
    {


        $this->assertEquals('/sIJyCJedGlZf1TId41gCtkblBGo.jpg', $this->tv->getBackdropPath());
        // created by
        $this->assertEquals(2, count($this->tv->getEpisodeRunTime()));
        $this->assertEquals(new \DateTime('2008-01-19'), $this->tv->getFirstAirDate());
        // genres
        $this->assertEquals('http://www.amctv.com/shows/breaking-bad', $this->tv->getHomepage());
        $this->assertEquals(1396, $this->tv->getId());
        $this->assertEquals(false, $this->tv->getInProduction());
        // languages
        $this->assertEquals(new \DateTime('2013-09-29'), $this->tv->getLastAirDate());
        $this->assertEquals('Breaking Bad', $this->tv->getName());
        // networks
        $this->assertEquals(62, $this->tv->getNumberOfEpisodes());
        $this->assertEquals(5, $this->tv->getNumberOfSeasons());
        $this->assertEquals('Breaking Bad', $this->tv->getOriginalName());
        $this->assertEquals('en', $this->tv->getOriginalLanguage());
        // origin_country
        $this->assertEquals('external', $this->tv->getOverview());
        $this->assertEquals(8.14745667435, $this->tv->getPopularity());
        $this->assertEquals('/iRDNn9EHKuBhGa77UBteazvsZa1.jpg', $this->tv->getPosterPath());
        // seasons
        $this->assertEquals('Ended', $this->tv->getStatus());
        $this->assertEquals(8.9, $this->tv->getVoteAverage());
        $this->assertEquals(37, $this->tv->getVoteCount());
        // credits
        // external_ids
        // images
        // translations
        $this->assertEquals(2, count($this->tv->getContentRatings()));

        $contentRatings = $this->tv->getContentRatings()->getAll();
        $usContentRating = array_shift($contentRatings);

        $this->assertEquals('US', $usContentRating->getIso31661());
        $this->assertEquals('TV-MA', $usContentRating->getRating());
    }

    /**
     * @test
     */
    public function shouldBeAbleToDissectResults()
    {
        $factory = $this->getFactory();

        $data = ['results' => [
            ['id' => 1],
            ['id' => 2],
        ]];

        $collection = $factory->createCollection($data);

        $this->assertEquals(2, count($collection));
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TvFactory';
    }
}
