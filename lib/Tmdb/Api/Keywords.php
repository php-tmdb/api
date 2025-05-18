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
 * Class Keywords.
 *
 * @see http://docs.themoviedb.apiary.io/#keywords
 */
class Keywords extends AbstractApi
{
    /**
     * Get the basic information for a specific keyword id.
     *
     * @param int $keyword_id
     */
    public function getKeyword($keyword_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('keyword/' . $keyword_id, $parameters, $headers);
    }

    /**
     * Get the list of movies for a particular keyword by id.
     *
     * @param int $keyword_id
     */
    public function getMovies($keyword_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('keyword/' . $keyword_id . '/movies', $parameters, $headers);
    }
}
