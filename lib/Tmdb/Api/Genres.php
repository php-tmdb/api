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

class Genres
    extends AbstractApi
{
    /**
     * Get the list of genres, and return one by id
     *
     * @param integer $id
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getGenre($id, array $options = array(), array $headers = array())
    {
        $response = $this->getGenres($options, $headers);

        if (array_key_exists('genres', $response)) {
            foreach($response['genres'] as $genre) {
                if ($id == $genre['id']) {
                    return $genre;
                }
            }
        }

        return null;
    }

    /**
     * Get the list of genres.
     *
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getGenres(array $options = array(), array $headers = array())
    {
        return $this->get('genre/list', $options, $headers);
    }

    /**
     * Get the list of movies for a particular genre by id. By default, only movies with 10 or more votes are included.
     *
     * @param $genre_id
     * @param array $options
     * @param array $headers
     * @return mixed
     */
    public function getMovies($genre_id, array $options = array(), array $headers = array())
    {
        return $this->get('genre/' . $genre_id . '/movies', $options, $headers);
    }
}