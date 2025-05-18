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
 * Class Companies.
 *
 * @see http://docs.themoviedb.apiary.io/#companies
 */
class Companies extends AbstractApi
{
    /**
     * This method is used to retrieve all of the basic information about a company.
     */
    public function getCompany(string $company_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('company/' . $company_id, $parameters, $headers);
    }

    /**
     * Get the list of movies associated with a particular company.
     *
     * @param int $company_id
     */
    public function getMovies($company_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('company/' . $company_id . '/movies', $parameters, $headers);
    }
}
