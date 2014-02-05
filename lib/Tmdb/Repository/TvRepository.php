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

use Tmdb\Factory\TvFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Tv;
use Tmdb\Model\Tv\QueryParameter\AppendToResponse;

class TvRepository extends AbstractRepository {

    /**
     * Load a tv with the given identifier
     *
     * If you want to optimize the result set/bandwidth you should define the AppendToResponse parameter
     *
     * @param integer $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function load($id, array $parameters = array(), array $headers = array())
    {

        if (empty($parameters)) {
            $parameters = array(
                new AppendToResponse(array(
                    AppendToResponse::CREDITS,
                    AppendToResponse::EXTERNAL_IDS,
                    AppendToResponse::IMAGES,
                    AppendToResponse::TRANSLATIONS
                ))
            );
        }

        $data = $this->getApi()->getTvshow($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the Tvs API Class
     *
     * @return \Tmdb\Api\Tv
     */
    public function getApi()
    {
        return $this->getClient()->getTvApi();
    }

    /**
     * @return TvFactory
     */
    public function getFactory()
    {
        return new TvFactory();
    }

    /**
     * Get the list of popular tvs on The Tv Database. This list refreshes every day.
     *
     * @param array $options
     * @return Tv[]
     */
    public function getPopular(array $options = array())
    {
        return $this->createCollection(
            $this->getApi()->getPopular($options)
        );
    }

    /**
     * Get the list of top rated tvs. By default, this list will only include tvs that have 10 or more votes. This list refreshes every day.
     *
     * @param array $options
     * @return Tv[]
     */
    public function getTopRated(array $options = array())
    {
        return $this->createCollection(
            $this->getApi()->getTopRated($options)
        );
    }

    /**
     * Create an collection of an array
     *
     * @todo Allow an array of Tv objects to pass ( custom collection )
     *
     * @param $data
     * @return Tv[]
     */
    private function createCollection($data){
        return $this->getFactory()->createCollection($data);
    }
}
