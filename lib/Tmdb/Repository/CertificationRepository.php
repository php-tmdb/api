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

use Tmdb\Api\Certifications;
use Tmdb\Factory\CertificationFactory;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class CertificationRepository
 * @package Tmdb\Repository
 * @see http://docs.themoviedb.apiary.io/#certifications
 */
class CertificationRepository extends AbstractRepository
{
    /**
     * Get the list of supported certifications for movies.
     *
     * These can be used in conjunction with the certification_country
     * and certification.lte parameters when using discover.
     *
     * @param $parameters
     * @param $headers
     * @return GenericCollection
     */
    public function getMovieList(array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getMovieList($this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->createCollection($data);
    }

    /**
     * Return the Collection API Class
     *
     * @return Certifications
     */
    public function getApi()
    {
        return $this->getClient()->getCertificationsApi();
    }

    /**
     * @return CertificationFactory
     */
    public function getFactory()
    {
        return new CertificationFactory($this->getClient()->getHttpClient());
    }

    /**
     * Get the list of supported certifications for tv shows.
     *
     * These can be used in conjunction with the certification_country
     * and certification.lte parameters when using discover.
     *
     * @param $parameters
     * @param $headers
     * @return GenericCollection
     */
    public function getTvList(array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getTvList($this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->createCollection($data);
    }
}
