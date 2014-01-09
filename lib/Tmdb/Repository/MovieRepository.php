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
use Tmdb\Model\Common\Collection;
use Tmdb\Model\Movie;

class MovieRepository extends AbstractRepository {

    /**
     * Load a movie with the given identifier
     *
     * @param $id
     * @param $parameters
     * @return Movie
     */
    public function load($id, array $parameters = array()) {

        if (empty($parameters) && $parameters !== false) {
            // Load a no-nonsense default set
            $parameters = array(
                new \Tmdb\Model\Movie\QueryParameter\AppendToResponse(array(
                    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::CREDITS,
                    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::IMAGES,
                    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::KEYWORDS,
                    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::RELEASES,
                    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::TRAILERS,
                    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::TRANSLATIONS,
                ))
            );
        }

        $data = $this->getApi()->getMovie($id, $this->parseQueryParameters($parameters));

        return MovieFactory::create($data);
    }

    /**
     * If you obtained an movie model which is not completely hydrated, you can use this function.
     *
     * @todo store the previous given parameters so the same conditions apply to a refresh, and merge the new set
     *
     * @param Movie $movie
     * @param array $parameters
     * @return Movie
     */
    public function refresh(Movie $movie, array $parameters = array()) {
        return $this->load($movie->getId(), $parameters);
    }

    /**
     * Return the Movies API Class
     *
     * @return \Tmdb\Api\Movies
     */
    public function getApi()
    {
        return $this->getClient()->getMovieApi();
    }

    /**
     * Get the latest movie.
     *
     * @param array $options
     * @return Movie
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
     * @return Collection
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
     * @return Collection
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
     * @return Collection
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
     * @return Collection
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
     * @todo Allow an array of Movie objects to pass ( custom collection )
     *
     * @param $data
     * @return Collection
     */
    private function createCollection($data){
        $collection = new Collection();

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach($data as $item) {
            $collection->add(null, MovieFactory::create($item));
        }

        return $collection;
    }

}