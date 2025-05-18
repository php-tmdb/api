<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Api;

/**
 * Class Movies.
 *
 * @see http://docs.themoviedb.apiary.io/#movies
 */
class Movies extends AbstractApi
{
    /**
     * Get the basic movie information for a specific movie id.
     */
    public function getMovie(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id, $parameters, $headers);
    }

    /**
     * Get the alternative titles for a specific movie id.
     */
    public function getAlternativeTitles(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/alternative_titles', $parameters, $headers);
    }

    /**
     * Get the cast and crew information for a specific movie id.
     */
    public function getCredits(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/credits', $parameters, $headers);
    }

    /**
     * Get the images (posters and backdrops) for a specific movie id.
     */
    public function getImages(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/images', $parameters, $headers);
    }

    /**
     * Get the plot keywords for a specific movie id.
     */
    public function getKeywords(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/keywords', $parameters, $headers);
    }

    /**
     * Get the release date by country for a specific movie id.
     */
    public function getReleases(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/releases', $parameters, $headers);
    }

    /**
     * Get the trailers for a specific movie id.
     *
     * @deprecated TMDB changed the way of requesting trailers, see getVideos instead!
     */
    public function getTrailers(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/trailers', $parameters, $headers);
    }

    /**
     * Get the translations for a specific movie id.
     */
    public function getTranslations(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/translations', $parameters, $headers);
    }

    /**
     * Get the similar movies for a specific movie id.
     */
    public function getSimilar(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/similar', $parameters, $headers);
    }

    /**
     * Get the recommended movies for a specific movie id.
     */
    public function getRecommendations(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/recommendations', $parameters, $headers);
    }

    /**
     * Get the reviews for a particular movie id.
     */
    public function getReviews(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/reviews', $parameters, $headers);
    }

    /**
     * Get the lists that the movie belongs to.
     */
    public function getLists(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/lists', $parameters, $headers);
    }

    /**
     * Get the changes for a specific movie id.
     */
    public function getChanges(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/changes', $parameters, $headers);
    }

    /**
     * Get the latest movie id.
     */
    public function getLatest(array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/latest', $parameters, $headers);
    }

    /**
     * Get the list of upcoming movies. This list refreshes every day.
     * The maximum number of items this list will include is 100.
     */
    public function getUpcoming(array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/upcoming', $parameters, $headers);
    }

    /**
     * Get the list of movies playing in theatres. This list refreshes every day.
     * The maximum number of items this list will include is 100.
     */
    public function getNowPlaying(array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/now_playing', $parameters, $headers);
    }

    /**
     * Get the list of popular movies on The Movie Database.
     * This list refreshes every day.
     */
    public function getPopular(array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/popular', $parameters, $headers);
    }

    /**
     * Get the list of top rated movies. By default, this list will only include
     * movies that have 10 or more votes. This list refreshes every day.
     */
    public function getTopRated(array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/top_rated', $parameters, $headers);
    }

    /**
     * This method lets users get the status of whether or not the movie has been rated
     * or added to their favourite or watch lists.
     *
     * A valid session id is required.
     *
     * @param int $id
     */
    public function getAccountStates($id): array
    {
        return $this->get('movie/' . $id . '/account_states');
    }

    /**
     * TThis method lets users rate a movie.
     *
     * A valid session id or guest session id is required.
     *
     * @param int   $id
     * @param float $rating
     */
    public function rateMovie($id, $rating): array
    {
        return $this->postJson('movie/' . $id . '/rating', ['value' => (float) $rating]);
    }

    /**
     * Get the videos (trailers, teasers, clips, etc...) for a specific movie id.
     */
    public function getVideos(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/videos', $parameters, $headers);
    }

    /**
     * Get the watch providers (by region) for a specific movie id.
     */
    public function getWatchProviders(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/watch/providers', $parameters, $headers);
    }

    /**
     * Get the external ids that we have stored for a movie.
     */
    public function getExternalIds(string $movie_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('movie/' . $movie_id . '/external_ids', $parameters, $headers);
    }
}
