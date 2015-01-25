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
namespace Tmdb\Tests\Model\Query\Discover;

use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Genre;
use Tmdb\Model\Query\Discover\DiscoverMoviesQuery;
use Tmdb\Tests\TestCase;

class DiscoverMoviesQueryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateValidQuery()
    {
        $query = new DiscoverMoviesQuery();
        $now   = new \DateTime();

        $query
            ->page(1)
            ->language('en')
            ->sortBy('sort')
            ->includeAdult(false)
            ->year($now)
            ->primaryReleaseYear($now)
            ->voteCountGte(5)
            ->voteAverageGte(3)
            ->withGenres([15,18])
            ->releaseDateGte($now)
            ->releaseDateLte($now)
            ->certificationCountry('NL')
            ->certificationLte(1)
            ->withCompanies([1])
        ;

        $this->assertEquals(14, count($query));
    }

    /**
     * @test
     */
    public function shouldNormalize()
    {
        $query = new DiscoverMoviesQuery();

        $genre = new Genre();
        $genre->setId(1);

        $genreTwo = new Genre();
        $genreTwo->setId(5);

        $query
            ->withGenres([$genre, $genreTwo])
        ;

        $this->assertEquals("1|5", $query->get('with_genres'));

        $query      = new DiscoverMoviesQuery();
        $collection = new Genres();

        $collection
            ->addGenre($genre)
            ->addGenre($genreTwo)
        ;

        $query->withGenres($collection);

        $this->assertEquals("1|5", $query->get('with_genres'));
    }

    /**
     * @test
     */
    public function verifyOr()
    {
        $query = new DiscoverMoviesQuery();

        $genre = new Genre();
        $genre->setId(1);

        $genreTwo = new Genre();
        $genreTwo->setId(5);

        $query
            ->withGenres([$genre, $genreTwo], DiscoverMoviesQuery::MODE_AND)
        ;

        $this->assertEquals("1,5", $query->get('with_genres'));
    }
}
