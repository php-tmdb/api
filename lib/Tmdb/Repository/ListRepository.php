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

use Tmdb\Factory\ListFactory;
use Tmdb\Model\Collection\Jobs;
use Tmdb\Model\Job;

class ListRepository extends AbstractRepository {
    /**
     * Get a list by id.
     *
     * @param string $id
     * @param array $parameters
     * @param array $headers
     * @return Job
     */
    public function load($id, array $parameters = array(), array $headers = array()) {
        return $this->getFactory()->create(
            $this->getApi()->getList($id, $parameters, $headers)
        );
    }

    /**
     * Check to see if a movie ID is already added to a list.
     *
     * @param int $id
     * @param array $parameters
     * @param array $headers
     * @return Jobs|Job[]
     */
    public function getItemStatus($id, array $parameters = array(), array $headers = array())
    {
        return $this->getFactory()->createItemStatus(
            $this->getApi()->getItemStatus($id, $parameters, $headers)
        );
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\Lists
     */
    public function getApi()
    {
        return $this->getClient()->getListsApi();
    }

    /**
     * @return ListFactory
     */
    public function getFactory()
    {
        return new ListFactory();
    }
}