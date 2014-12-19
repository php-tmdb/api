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

use Tmdb\Model\Collection\Genres;

class GenreFactoryTest extends TestCase
{
    const GENRE_ID = 28;

    /**
     * @test
     */
    public function shouldConstructGenres()
    {
        $factory = $this->getFactory();
        $data    = $this->loadByFile('genre/list.json');

        $collection = $factory->createCollection($data['genres']);

        $this->assertInstanceOf('Tmdb\Model\Collection\Genres', $collection);

        $filteredGenres = $collection->filterId(self::GENRE_ID);

        foreach ($filteredGenres as $filteredGenre) {
            $this->assertInstanceOf('Tmdb\Model\Genre', $filteredGenre);

            $this->assertEquals('Action', $filteredGenre->getName());
        }
    }

    /**
     * @test
     */
    public function shouldFilter()
    {
        $factory = $this->getFactory();
        $data    = $this->loadByFile('genre/list.json');

        /**
         * @var Genres $genres
         */
        $genres = $factory->createCollection($data);
        $filteredGenre = $genres->filterId(self::GENRE_ID);

        $this->assertEquals('Action', $filteredGenre->getName());
    }

    /**
     * @test
     */
    public function shouldCollaborateWithCollection()
    {
        $factory = $this->getFactory();
        $data    = $this->loadByFile('genre/list.json');

        /**
         * @var Genres $genres
         */
        $genres = $factory->createCollection($data['genres']);

        $this->assertEquals(count($data['genres']), count($genres->getGenres()));

        $genre = $genres->getGenre(28);
        $this->assertEquals('Action', $genre->getName());

        $genre = $genres->getGenre(-1);
        $this->assertEquals(null, $genre);
    }

    /**
     * @test
     */
    public function shouldBeAbleToDissectResults()
    {
        $factory = $this->getFactory();

        $data = ['genres' => [
            ['id' => 1],
            ['id' => 2],
        ]];

        $collection = $factory->createCollection($data);

        $this->assertEquals(2, count($collection));
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\GenreFactory';
    }
}
