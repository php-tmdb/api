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

use Tmdb\Model\Query\Discover\DiscoverMoviesQuery;
use Tmdb\Tests\TestCase;

class DiscoverMoviesQueryTest extends TestCase
{
    /**
     * @todo expand
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
            ->withGenres(array(15,18))
            ->withGenresAnd(array(18))
            ->withGenresOr(array(1,2))
            ->releaseDateGte($now)
            ->releaseDateLte($now)
            ->certificationCountry('NL')
            ->certificationLte(1)
            ->withCompanies(array(1))
            ->withCompaniesAnd(array(2,5))
        ;

        $this->assertEquals(13, count($query));
    }
}
