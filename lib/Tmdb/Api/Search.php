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

class Search
    extends AbstractApi
{
    /**
     * Search for movies by title.
     *
     * @param $query
     * @param array $options
     * @return mixed
     */
    public function searchMovies($query, array $options = array())
    {
        return $this->get('search/movie', array_merge($options, array(
            'query' => $query
        )));
    }

    /**
     * Search for collections by name.
     *
     * @param $query
     * @param array $options
     * @return mixed
     */
    public function searchCollection($query, array $options = array())
    {
        return $this->get('search/collection', array_merge($options, array(
            'query' => $query
        )));
    }

    /**
     * Search for TV shows by title.
     *
     * @param $query
     * @param array $options
     * @return mixed
     */
    public function searchTv($query, array $options = array())
    {
        return $this->get('search/tv', array_merge($options, array(
            'query' => $query
        )));
    }

    /**
     * Search for people by name.
     *
     * @param $query
     * @param array $options
     * @return mixed
     */
    public function searchPersons($query, array $options = array())
    {
        return $this->get('search/person', array_merge($options, array(
            'query' => $query
        )));
    }

    /**
     * Search for lists by name and description.
     *
     * @param $query
     * @param array $options
     * @return mixed
     */
    public function searchList($query, array $options = array())
    {
        return $this->get('search/list', array_merge($options, array(
            'query' => $query
        )));
    }

    /**
     * Search for companies by name.
     *
     * @param $query
     * @param array $options
     * @return mixed
     */
    public function searchCompany($query, array $options = array())
    {
        return $this->get('search/company', array_merge($options, array(
            'query' => $query
        )));
    }

    /**
     * Search for companies by name.
     *
     * @param $query
     * @param array $options
     * @return mixed
     */
    public function searchKeyword($query, array $options = array())
    {
        return $this->get('search/keyword', array_merge($options, array(
            'query' => $query
        )));
    }
}