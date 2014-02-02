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
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        $factory = new MovieFactory();

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

    public function shouldBeFunctional()
    {
        $this->assertEquals(false, $this->movie->getAdult());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\MovieFactory';
    }
}