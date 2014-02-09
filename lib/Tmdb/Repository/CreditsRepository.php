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
use Tmdb\Factory\CreditsFactory;
use Tmdb\Factory\TvFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Company;
use Tmdb\Model\Movie;

class CreditsRepository extends AbstractRepository {

    /**
     * Load a company with the given identifier
     *
     * @param $id
     * @param array $parameters
     * @param array $headers
     * @return Company
     */
    public function load($id, array $parameters = array(), array $headers = array()) {
        $data = $this->getApi()->getCredit($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\Credits
     */
    public function getApi()
    {
        return $this->getClient()->getCreditsApi();
    }

    /**
     * @return CompanyFactory
     */
    public function getFactory()
    {
        return new CreditsFactory();
    }

    /**
     * @return TvFactory
     */
    public function getTvFactory()
    {
        return new TvFactory();
    }

    /**
     * Create an collection of an array
     *
     * @param $data
     * @return Movie[]
     */
    public function createMovieCollection($data){
        $collection = new GenericCollection();

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach($data as $item) {
            $collection->add(null, $this->getMovieFactory()->create($item));
        }

        return $collection;
    }
}
