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
namespace Tmdb\Repository;

use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\TvFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Query\Discover\DiscoverMoviesQuery;
use Tmdb\Model\Query\Discover\DiscoverTvQuery;

class DiscoverRepository extends AbstractRepository {
    /**
     * Discover movies by different types of data like average rating, number of votes, genres and certifications.
     *
     * @param DiscoverMoviesQuery $query
     * @param array $headers
     * @return GenericCollection
     */
    public function discoverMovies(DiscoverMoviesQuery $query, array $headers = array()) {
        $data = $this->getApi()->discoverMovies($query->toArray(), $this->parseHeaders($headers));

        return MovieFactory::createCollection($data);
    }

    /**
     * Discover TV shows by different types of data like average rating, number of votes, genres, the network they aired on and air dates.
     *
     * @param DiscoverTvQuery $query
     * @param array $headers
     * @return GenericCollection
     */
    public function discoverTv(DiscoverTvQuery $query, array $headers = array()) {
        $data = $this->getApi()->discoverTv($query->toArray(), $this->parseHeaders($headers));

        return TvFactory::createCollection($data);
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\Discover
     */
    public function getApi()
    {
        return $this->getClient()->getDiscoverApi();
    }
}