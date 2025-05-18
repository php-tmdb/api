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

namespace Tmdb\Api;

/**
 * Class Discover.
 *
 * @see http://docs.themoviedb.apiary.io/#discover
 */
class Discover extends AbstractApi
{
    /**
     * Discover movies by different types of data like average rating, number of votes, genres and certifications.
     */
    public function discoverMovies(array $parameters = [], array $headers = []): array
    {
        return $this->get('discover/movie', $parameters, $headers);
    }

    /**
     * Discover TV shows by different types of data like average rating, number of votes, genres,
     * the network they aired on and air dates.
     */
    public function discoverTv(array $parameters = [], array $headers = []): array
    {
        return $this->get('discover/tv', $parameters, $headers);
    }
}
