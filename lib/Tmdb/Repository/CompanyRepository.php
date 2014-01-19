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

use Tmdb\Factory\CompanyFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Company;

class CompanyRepository extends AbstractRepository {
    /**
     * Load a company with the given identifier
     *
     * @param $id
     * @param array $parameters
     * @param array $headers
     * @return Company
     */
    public function load($id, array $parameters = array(), array $headers = array()) {
        $data = $this->getApi()->getCompany($id, $this->parseQueryParameters($parameters), $this->parseHeaders($headers));

        return CompanyFactory::create($data);
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\Companies
     */
    public function getApi()
    {
        return $this->getClient()->getCompaniesApi();
    }
}