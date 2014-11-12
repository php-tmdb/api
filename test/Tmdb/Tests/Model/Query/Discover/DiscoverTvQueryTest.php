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

use Tmdb\Model\Query\Discover\DiscoverTvQuery;
use Tmdb\Tests\TestCase;

class DiscoverTvQueryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateValidQuery()
    {
        $query = new DiscoverTvQuery();
        $now   = new \DateTime();

        $query
            ->page(1)
            ->language('en')
            ->sortBy('sort')
            ->firstAirDateYear($now)
            ->voteCountGte(5)
            ->voteAverageGte(3)
            ->withGenres([15,18])
            ->withGenresOr([1,2])
            ->withGenresAnd([18])
            ->firstAirDateGte($now)
            ->firstAirDateLte($now)
            ->withNetworks([1,2])
            ->withNetworksAnd([1,2,3])
        ;

        $this->assertEquals(10, count($query));
    }
}
