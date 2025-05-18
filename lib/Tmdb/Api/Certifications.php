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
 * Class Certifications.
 *
 * @see http://docs.themoviedb.apiary.io/#certifications
 */
class Certifications extends AbstractApi
{
    /**
     * Get the list of supported certifications for movies.
     *
     * These can be used in conjunction with the certification_country and
     * certification.lte parameters when using discover.
     */
    public function getMovieList(array $parameters = [], array $headers = []): array
    {
        return $this->get('certification/movie/list', $parameters, $headers);
    }

    /**
     * Get the list of supported certifications for tv shows.
     *
     * These can be used in conjunction with the certification_country and
     * certification.lte parameters when using discover.
     */
    public function getTvList(array $parameters = [], array $headers = []): array
    {
        return $this->get('certification/tv/list', $parameters, $headers);
    }
}
