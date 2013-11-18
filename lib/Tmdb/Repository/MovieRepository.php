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
use Tmdb\Model\Movie;

class MovieRepository extends AbstractRepository {
    /**
     * Load a movie with the given identifier
     *
     * @param $id
     * @param $parameters
     * @return Movie
     */
    public static function load($id, array $parameters = array()) {
        $data = parent::getClient()->getMovieApi()->getMovie($id, parent::parseQueryParameters($parameters));

        return MovieFactory::create($data);
    }

    /**
     * If you obtained an movie model which is not completely hydrated, you can use this function. ( E.g. similar_movies )
     *
     * Do note that you will have to provide the AppendToResponse object into the parameters array of which data
     * you would like to obtain.
     *
     * array(AppendToResponse(array(...)))
     *
     * @param Movie $movie
     * @param array $parameters
     * @return Movie
     */
    public function refresh(Movie $movie, array $parameters = array()) {
        return self::load($movie->getId(), $parameters);
    }
}