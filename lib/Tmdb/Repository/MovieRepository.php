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

use Tmdb\Factory\MovieFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Movie;

use \Tmdb\Model\Movie\QueryParameter\AppendToResponse;

class MovieRepository extends AbstractRepository {

    /**
     * Load a movie with the given identifier
     *
     * If you want to optimize the result set/bandwidth you should define the AppendToResponse parameter
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function load($id, array $parameters = array(), array $headers = array())
    {

        if (empty($parameters)) {
            $parameters = array(
                new AppendToResponse(array(
                    AppendToResponse::ALTERNATIVE_TITLES,
                    AppendToResponse::CHANGES,
                    AppendToResponse::CREDITS,
                    AppendToResponse::IMAGES,
                    AppendToResponse::KEYWORDS,
                    AppendToResponse::LISTS,
                    AppendToResponse::RELEASES,
                    AppendToResponse::REVIEWS,
                    AppendToResponse::SIMILAR_MOVIES,
                    AppendToResponse::TRAILERS,
                    AppendToResponse::TRANSLATIONS,
                ))
            );
        }

        $data = $this->getApi()->getMovie($id, $this->parseQueryParameters($parameters), $this->parseHeaders($headers));

        return MovieFactory::create($data);
    }

    /**
     * Return the Movies API Class
     *
     * @return \Tmdb\Api\Movies
     */
    public function getApi()
    {
        return $this->getClient()->getMoviesApi();
    }

    /**
     * Get the latest movie.
     *
     * @param array $options
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getLatest(array $options = array())
    {
        return MovieFactory::create(
            $this->getApi()->getLatest($options)
        );
    }

    /**
     * Get the list of upcoming movies. This list refreshes every day. The maximum number of items this list will include is 100.
     *
     * @param array $options
     * @return Movie[]
     */
    public function getUpcoming(array $options = array())
    {
        return $this->createCollection(
            $this->getApi()->getUpcoming($options)
        );
    }

    /**
     * Get the list of movies playing in theatres. This list refreshes every day. The maximum number of items this list will include is 100.
     *
     * @param array $options
     * @return Movie[]
     */
    public function getNowPlaying(array $options = array())
    {
        return $this->createCollection(
            $this->getApi()->getNowPlaying($options)
        );
    }

    /**
     * Get the list of popular movies on The Movie Database. This list refreshes every day.
     *
     * @param array $options
     * @return Movie[]
     */
    public function getPopular(array $options = array())
    {
        return $this->createCollection(
            $this->getApi()->getPopular($options)
        );
    }

    /**
     * Get the list of top rated movies. By default, this list will only include movies that have 10 or more votes. This list refreshes every day.
     *
     * @param array $options
     * @return Movie[]
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
     * @param $data
     * @return Movie[]
     */
    private function createCollection($data){
        $collection = new GenericCollection();

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach($data as $item) {
            $collection->add(null, MovieFactory::create($item));
        }

        return $collection;
    }

}