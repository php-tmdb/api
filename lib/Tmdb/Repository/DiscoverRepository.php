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
 * @version 4.0.0
 */

namespace Tmdb\Repository;

use Tmdb\Api\Discover;
use Tmdb\Exception\NotImplementedException;
use Tmdb\Exception\RuntimeException;
use Tmdb\Factory\FactoryInterface;
use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\TvFactory;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Query\Discover\DiscoverMoviesQuery;
use Tmdb\Model\Query\Discover\DiscoverTvQuery;

/**
 * Class DiscoverRepository
 * @package Tmdb\Repository
 * @see http://docs.themoviedb.apiary.io/#discover
 */
class DiscoverRepository extends AbstractRepository
{
    /**
     * Discover movies by different types of data like average rating,
     * number of votes, genres and certifications.
     *
     * @param DiscoverMoviesQuery $query
     * @param array $headers
     *
     * @return ResultCollection
     * @throws RuntimeException    when certification_country is set but certification.lte is not given
     *
     */
    public function discoverMovies(DiscoverMoviesQuery $query, array $headers = []): ResultCollection
    {
        $query = $query->toArray();

        if (array_key_exists('certification_country', $query) && !array_key_exists('certification.lte', $query)) {
            throw new RuntimeException(
                'When the certification_country option is given the certification.lte option is required.'
            );
        }

        $data = $this->getApi()->discoverMovies($query, $headers);

        return $this->getMovieFactory()->createResultCollection($data);
    }

    /**
     * Return the related API class
     *
     * @return Discover
     */
    public function getApi()
    {
        return $this->getClient()->getDiscoverApi();
    }

    /**
     * @return MovieFactory
     */
    public function getMovieFactory()
    {
        return new MovieFactory($this->getClient()->getHttpClient());
    }

    /**
     * Discover TV shows by different types of data like average rating,
     * number of votes, genres, the network they aired on and air dates.
     *
     * @param DiscoverTvQuery $query
     * @param array $headers
     *
     * @return ResultCollection
     */
    public function discoverTv(DiscoverTvQuery $query, array $headers = []): ResultCollection
    {
        $data = $this->getApi()->discoverTv($query->toArray(), $headers);

        return $this->getTvFactory()->createResultCollection($data);
    }

    /**
     * @return TvFactory
     */
    public function getTvFactory()
    {
        return new TvFactory($this->getClient()->getHttpClient());
    }

    /**
     * Discover currently does not offer an factory
     *
     * @return void
     * @throws NotImplementedException
     */
    public function getFactory()
    {
        throw new NotImplementedException('Discover does not support a generic factory.');
    }
}
