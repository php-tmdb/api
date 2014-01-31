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

class GenreFactoryTest extends TestCase
{
    const GENRE_ID = 28;

    /**
     * @test
     */
    public function shouldConstructGenres()
    {
        $factory = $this->getFactory();
        $data    = $this->loadByFile('genre/result.json');

        $collection = $factory->createCollection($data['genres']);

        $this->assertInstanceOf('Tmdb\Model\Collection\Genres', $collection);

        $filteredGenres = $collection->filterId(self::GENRE_ID);

        // @todo actually get the first
        foreach($filteredGenres as $filteredGenre) {
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
        $data    = $this->loadByFile('genre/result.json');

        $collection     = $factory->createCollection($data['genres']);
        $filteredGenres = $collection->filterId(self::GENRE_ID);

        foreach($filteredGenres as $filteredGenre) {
            $this->assertEquals('Action', $filteredGenre->getName());
        }
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\GenreFactory';
    }
}