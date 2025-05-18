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

use Tmdb\Api\Companies;
use Tmdb\Factory\CompanyFactory;
use Tmdb\Factory\MovieFactory;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Company;

/**
 * Class CompanyRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#movies
 */
class CompanyRepository extends AbstractRepository
{
    /**
     * Load a company with the given identifier.
     */
    public function load(string $id, array $parameters = [], array $headers = []): \Tmdb\Model\Company
    {
        $data = $this->getApi()->getCompany($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the related API class.
     *
     * @return Companies
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getCompaniesApi();
    }

    #[\Override]
    public function getFactory(): \Tmdb\Factory\CompanyFactory
    {
        return new CompanyFactory($this->getClient()->getHttpClient());
    }

    /**
     * Get the list of movies associated with a particular company.
     *
     * @param int $id
     *
     * @return ResultCollection
     */
    public function getMovies($id, array $parameters = [], array $headers = [])
    {
        return $this->createMovieCollection(
            $this->getApi()->getMovies($id, $this->parseQueryParameters($parameters), $headers),
        );
    }

    /**
     * Create an collection of an array.
     */
    public function createMovieCollection(array $data): \Tmdb\Model\Collection\ResultCollection
    {
        $collection = new ResultCollection();

        if (\array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach ($data as $item) {
            $collection->add(null, $this->getMovieFactory()->create($item));
        }

        return $collection;
    }

    public function getMovieFactory(): \Tmdb\Factory\MovieFactory
    {
        return new MovieFactory($this->getClient()->getHttpClient());
    }
}
