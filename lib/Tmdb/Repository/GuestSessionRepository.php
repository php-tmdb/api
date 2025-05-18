<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Repository;

use Tmdb\Api\GuestSession;
use Tmdb\Factory\GuestSessionFactory;
use Tmdb\Factory\MovieFactory;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Movie;

/**
 * Class GuestSessionRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#guestsessions
 */
class GuestSessionRepository extends AbstractRepository
{
    /**
     * Get the list of top rated movies.
     *
     * By default, this list will only include movies that have 10 or more votes.
     * This list refreshes every day.
     *
     * @return ResultCollection|Movie[]
     */
    public function getRatedMovies(array $options = []): \Tmdb\Model\Collection\ResultCollection
    {
        return $this->getMovieFactory()->createResultCollection(
            $this->getApi()->getRatedMovies($options),
        );
    }

    public function getMovieFactory(): \Tmdb\Factory\MovieFactory
    {
        return new MovieFactory($this->getClient()->getHttpClient());
    }

    /**
     * Return the Movies API Class.
     *
     * @return GuestSession
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getGuestSessionApi();
    }

    /**
     * Return the Guest Session Factory.
     */
    #[\Override]
    public function getFactory(): \Tmdb\Factory\GuestSessionFactory
    {
        return new GuestSessionFactory($this->getClient()->getHttpClient());
    }
}
