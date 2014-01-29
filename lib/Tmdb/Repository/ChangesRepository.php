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

use Tmdb\Exception\NotImplementedException;
use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Model\Collection\People;
use Tmdb\Model\Query\ChangesQuery;

class ChangesRepository extends AbstractRepository {
    /**
     * Get a list of movie ids that have been edited.
     *
     * By default we show the last 24 hours and only 100 items per page.
     * The maximum number of days that can be returned in a single request is 14.
     *
     * You can then use the movie changes API to get the actual data that has been changed.
     * Please note that the change log system to support this was changed on October 5, 2012
     * and will only show movies that have been edited since.
     *
     * @param ChangesQuery $query
     * @param array $headers
     * @return \Tmdb\Model\Common\GenericCollection
     */
    public function getMovieChanges(ChangesQuery $query, array $headers = array()) {
        $data = $this->getApi()->getMovieChanges($query->toArray(), $this->parseHeaders($headers));

        return $this->getMovieFactory()->createCollection($data);
    }

    /**
     * Get a list of people ids that have been edited.
     *
     * By default we show the last 24 hours and only 100 items per page.
     * The maximum number of days that can be returned in a single request is 14.
     *
     * You can then use the person changes API to get the actual data that has been changed.
     * Please note that the change log system to support this was changed on October 5, 2012
     * and will only show people that have been edited since.
     *
     * @param ChangesQuery $query
     * @param array $headers
     * @return People
     */
    public function getPeopleChanges(ChangesQuery $query, array $headers = array()) {
        $data = $this->getApi()->getPersonChanges($query->toArray(), $this->parseHeaders($headers));

        return $this->getPeopleFactory()->createCollection($data);
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\Changes
     */
    public function getApi()
    {
        return $this->getClient()->getChangesApi();
    }

    /**
     * @return PeopleFactory
     */
    public function getPeopleFactory()
    {
        return new PeopleFactory();
    }

    /**
     * @return MovieFactory
     */
    public function getMovieFactory()
    {
        return new MovieFactory();
    }

    /**
     * Changes does not support a generic factory
     *
     * @throws NotImplementedException
     * @return null|\Tmdb\Factory\FactoryInterface
     */
    public function getFactory(){
        throw new NotImplementedException('Discover does not support a generic factory.');
    }
}
