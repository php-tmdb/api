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
namespace Tmdb\Api;

use Tmdb\Exception\NotImplementedException;

class Lists
    extends AbstractApi
{
    /**
     * Get a list by id.
     *
     * @param $list_id
     * @param array $options
     * @return mixed
     */
    public function getList($list_id, array $options = array())
    {
        return $this->get('list/' . $list_id, $options);
    }

    /**
     * This method lets users create a new list. A valid session id is required.
     *
     * @param $name
     * @param $description
     * @param $options array
     * @throws NotImplementedException
     * @return mixed
     */
    public function createList($name, $description, array $options = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Check to see if a movie ID is already added to a list.
     *
     * @param $list_id
     * @param $movie_id
     * @param array $options
     * @throws NotImplementedException
     * @return mixed
     */
    public function getItemStatus($list_id, $movie_id, array $options = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the cast information for a specific list id.
     *
     * @param $list_id
     * @param $media_id
     * @param array $options
     * @throws NotImplementedException
     * @return mixed
     */
    public function addMediaToList($list_id, $media_id, array $options = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the images (posters and backdrops) for a specific list id.
     *
     * @param $list_id
     * @param $media_id
     * @param array $options
     * @throws NotImplementedException
     * @return mixed
     */
    public function removeMediaFromList($list_id, $media_id, array $options = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the plot keywords for a specific list id.
     *
     * @param $list_id
     * @param array $options
     * @throws NotImplementedException
     * @return mixed
     */
    public function deleteList($list_id, array $options = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }
}