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

use Tmdb\Factory\MovieFactory;
use Tmdb\Model\Movie;
use Tmdb\Model\Movie\Release;
use Tmdb\Model\Movie\ReleaseDate;
use Tmdb\Model\Person\CastMember;

class MovieFactoryTest extends TestCase
{
    const MOVIE_ID = 120;

    /**
     * @var Movie
     */
    private $movie;

    public function setUp()
    {
        /**
         * @var MovieFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('movie/all.json');

        $this->movie = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructMovie()
    {
        $this->assertInstanceOf('Tmdb\Model\Movie', $this->movie);
        $this->assertInstanceOf('\DateTime', $this->movie->getReleaseDate());
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setCastFactory($class);
        $factory->setCrewFactory($class);
        $factory->setGenreFactory($class);
        $factory->setImageFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getCastFactory());
        $this->assertInstanceOf('stdClass', $factory->getCrewFactory());
        $this->assertInstanceOf('stdClass', $factory->getGenreFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $this->assertEquals(false, $this->movie->getAdult());
        $this->assertEquals('/7DlIoyQ3ecGMklVWyKsneZmVnsi.jpg', $this->movie->getBackdropPath());
        $this->assertInstanceOf('Tmdb\Model\Image\BackdropImage', $this->movie->getBackdropImage());
        $this->assertEquals(true, is_array($this->movie->getBelongsToCollection()));
        $this->assertEquals(true, is_int($this->movie->getBudget()));
        $this->assertInstanceOf('Tmdb\Model\Collection\Genres', $this->movie->getGenres());
        $this->assertEquals('http://www.riddick-movie.com', $this->movie->getHomepage());
        $this->assertEquals(87421, $this->movie->getId());
        $this->assertEquals('tt1411250', $this->movie->getImdbId());
        $this->assertEquals('Riddick', $this->movie->getTitle());
        $this->assertEquals('en', $this->movie->getOriginalLanguage());
        $this->assertEquals('Riddick', $this->movie->getOriginalTitle());
        $this->assertEquals('Betrayed by his own kind and left for dead on a desolate planet, Riddick fights for survival against alien predators and becomes more powerful and dangerous than ever before. Soon bounty hunters from throughout the galaxy descend on Riddick only to find themselves pawns in his greater scheme for revenge. With his enemies right where he wants them, Riddick unleashes a vicious attack of vengeance before returning to his home planet of Furya to save it from destruction.', $this->movie->getOverview());
        $this->assertEquals(93.491722439366, $this->movie->getPopularity());
        $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $this->movie->getPosterImage());
        $this->assertEquals('/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg', $this->movie->getPosterPath());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getProductionCompanies());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getProductionCountries());
        $this->assertEquals(new \DateTime('2013-09-06'), $this->movie->getReleaseDate());
        $this->assertEquals(42025135, $this->movie->getRevenue());
        $this->assertEquals(119, $this->movie->getRuntime());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getSpokenLanguages());
        $this->assertEquals('Released', $this->movie->getStatus());
        $this->assertEquals('Survival Is His Revenge', $this->movie->getTagline());
        $this->assertEquals(6.2, $this->movie->getVoteAverage());
        $this->assertEquals(625, $this->movie->getVoteCount());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getAlternativeTitles());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getChanges());
        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection', $this->movie->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->movie->getImages());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getKeywords());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getLists());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getReleases());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getReleaseDates());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getSimilar());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->movie->getRecommendations());
        $this->assertInstanceOf('Tmdb\Model\Collection\Videos', $this->movie->getVideos());

        /** @var Release[] $releases */
        $releases = $this->movie->getReleases()->getAll();
        $primaryRelease = array_shift($releases);
        $this->assertEquals(true, $primaryRelease->getPrimary());

        /** @var ReleaseDate[] $release_dates */
        $release_dates = $this->movie->getReleaseDates()->getAll();
        $this->assertEquals(46, count($release_dates));
        foreach($release_dates as $release_date) {
            $this->assertNotEmpty($release_date->getIso31661());
            $this->assertInstanceOf(\DateTime::class, $release_date->getReleaseDate());
            $this->assertTrue(is_int($release_date->getType()));
        }
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

    /**
     * @test
     */
    public function shouldGetProfileImages()
    {
        $cast = $this->movie->getCredits()->getCast();

        /**
         * @var CastMember $c
         */
        foreach ($cast as $c) {
            if ($c->hasProfileImage()) {
                $filePath = $c->getProfileImage()->getFilePath();
                $this->assertEquals(false, empty($filePath));
            } else {
                $this->assertEquals(null, $c->getProfileImage());
            }
        }
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\MovieFactory';
    }
}
