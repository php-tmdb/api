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

class Movies
    extends AbstractApi
{
    /**
     * Get the basic movie information for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getMovie($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id, $options, $headers);
    }

    /**
     * Get the alternative titles for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getAlternativeTitles($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/alternative_titles', $options, $headers);
    }

    /**
     * Get the cast information for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getCast($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/casts', $options, $headers);
    }

    /**
     * Get the images (posters and backdrops) for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getImages($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/images', $options, $headers);
    }

    /**
     * Get the plot keywords for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getKeywords($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/keywords', $options, $headers);
    }

    /**
     * Get the release date by country for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getReleases($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/releases', $options, $headers);
    }

    /**
     * Get the trailers for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getTrailers($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/trailers', $options, $headers);
    }

    /**
     * Get the translations for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getTranslations($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/translations', $options, $headers);
    }

    /**
     * Get the similar movies for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getSimilarMovies($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/similar_movies', $options, $headers);
    }

    /**
     * Get the reviews for a particular movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getReviews($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/reviews', $options, $headers);
    }

    /**
     * Get the lists that the movie belongs to.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getLists($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/lists', $options, $headers);
    }

    /**
     * Get the changes for a specific movie id.
     *
     * @param $movie_id
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getChanges($movie_id, array $options = array(), array $headers = array())
    {
        return $this->get('movie/' . $movie_id . '/changes', $options, $headers);
    }

    /**
     * Get the latest movie id.
     *
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getLatest(array $options = array(), array $headers = array())
    {
        return $this->get('movie/latest', $options, $headers);
    }

    /**
     * Get the list of upcoming movies. This list refreshes every day. The maximum number of items this list will include is 100.
     *
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getUpcoming(array $options = array(), array $headers = array())
    {
        return $this->get('movie/upcoming', $options, $headers);
    }

    /**
     * Get the list of movies playing in theatres. This list refreshes every day. The maximum number of items this list will include is 100.
     *
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getNowPlaying(array $options = array(), array $headers = array())
    {
        return $this->get('movie/now_playing', $options, $headers);
    }

    /**
     * Get the list of popular movies on The Movie Database. This list refreshes every day.
     *
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getPopular(array $options = array(), array $headers = array())
    {
        return $this->get('movie/popular', $options, $headers);
    }

    /**
     * Get the list of top rated movies. By default, this list will only include movies that have 10 or more votes. This list refreshes every day.
     *
     * @param array $options
	 * @param array $headers
     * @return mixed
     */
    public function getTopRated(array $options = array(), array $headers = array())
    {
        return $this->get('movie/top_rated', $options, $headers);
    }

    /**
     * This method lets users get the status of whether or not the movie has been rated or added to their favourite or watch lists. A valid session id is required.
     *
     * @throws \Tmdb\Exception\NotImplementedException
     */
    public function getAccountStates()
    {
        throw new NotImplementedException('TMDB account sessions have not been implemented yet!');
    }

    /**
     * TThis method lets users rate a movie. A valid session id or guest session id is required.
     *
     * @throws \Tmdb\Exception\NotImplementedException
     */
    public function rateMovie()
    {
        throw new NotImplementedException('TMDB account sessions have not been implemented yet!');
    }
}
