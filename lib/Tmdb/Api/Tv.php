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

/**
 * Class Tv
 * @package Tmdb\Api
 * @see http://docs.themoviedb.apiary.io/#tv
 */
class Tv extends AbstractApi
{
    /**
     * Get the primary information about a TV series by id.
     *
     * @param  integer $tvshow_id
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getTvshow($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id, $parameters, $headers);
    }

    /**
     * Get the cast & crew information about a TV series.
     * Just like the website, we pull this information from the last season of the series.
     *
     * @param $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getCredits($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/credits', $parameters, $headers);
    }

   /**
    * Get the content ratings for a specific TV show id.

    * @param $tvshow_id
    * @param  array $parameters
    * @param  array $headers
    * @return mixed
    */
    public function getContentRatings($tvshow_id, array $parameters = [], array $headers = [])
    {
       return $this->get('tv/' . $tvshow_id . '/content_ratings', $parameters, $headers);
    }

    /**
     * Get the external ids that we have stored for a TV series.
     *
     * @param $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getExternalIds($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/external_ids', $parameters, $headers);
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     *
     * @param $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getImages($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/images', $parameters, $headers);
    }

    /**
     * Get the list of popular TV shows. This list refreshes every day.
     *
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getPopular(array $parameters = [], array $headers = [])
    {
        return $this->get('tv/popular', $parameters, $headers);
    }

    /**
     * Get the list of top rated TV shows.
     *
     * By default, this list will only include TV shows that have 2 or more votes.
     * This list refreshes every day.
     *
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getTopRated(array $parameters = [], array $headers = [])
    {
        return $this->get('tv/top_rated', $parameters, $headers);
    }

    /**
     * Get the list of translations that exist for a TV series.
     *
     * These translations cascade down to the episode level.
     *
     * @param  int   $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getTranslations($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/translations', $parameters, $headers);
    }

    /**
     * Get the list of TV shows that are currently on the air.
     *
     * This query looks for any TV show that has an episode with an air date in the next 7 days.
     *
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getOnTheAir(array $parameters = [], array $headers = [])
    {
        return $this->get('tv/on_the_air', $parameters, $headers);
    }

    /**
     * Get the list of TV shows that air today.
     *
     * Without a specified timezone, this query defaults to EST (Eastern Time UTC-05:00).
     *
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getAiringToday(array $parameters = [], array $headers = [])
    {
        return $this->get('tv/airing_today', $parameters, $headers);
    }

    /**
     * Get the videos that have been added to a TV series (trailers, opening credits, etc...)
     *
     * @param  int   $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getVideos($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/videos', $parameters, $headers);
    }

    /**
     * Get the changes for a specific TV show id.
     *
     * Changes are grouped by key, and ordered by date in descending order.
     * By default, only the last 24 hours of changes are returned.
     * The maximum number of days that can be returned in a single request is 14.
     * The language is present on fields that are translatable.
     *
     * TV changes are different than movie changes in that there are some edits on seasons and episodes
     * that will create a change entry at the show level. They can be found under the season and episode keys.
     * These keys will contain a series_id and episode_id.
     *
     * You can use the /tv/season/{id}/changes and /tv/episode/{id}/changes methods to look up these specific changes.
     *
     * @param $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getChanges($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/changes', $parameters, $headers);
    }

    /**
     * Get the latest TV show id.
     *
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getLatest(array $parameters = [], array $headers = [])
    {
        return $this->get('tv/latest', $parameters, $headers);
    }

    /**
     * Get the plot keywords for a specific TV show id.
     *
     * @param $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getKeywords($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/keywords', $parameters, $headers);
    }

    /**
     * Get the similar TV shows for a specific tv id.
     *
     * @param $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getSimilar($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/similar', $parameters, $headers);
    }

    /**
     * Get the recommended TV shows for a specific tv id.
     *
     * @param $tvshow_id
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getRecommendations($tvshow_id, array $parameters = [], array $headers = [])
    {
        return $this->get('tv/' . $tvshow_id . '/recommendations', $parameters, $headers);
    }

    /**
     * This method lets users get the status of whether or not the TV show has been rated
     * or added to their favourite or watch lists.
     *
     * A valid session id is required.
     *
     * @param  integer $id
     * @return mixed
     */
    public function getAccountStates($id)
    {
        return $this->get('tv/' . $id . '/account_states');
    }

    /**
     * This method lets users rate a TV show.
     *
     * A valid session id or guest session id is required.
     *
     * @param  integer $id
     * @param  double  $rating
     * @return mixed
     */
    public function rateTvShow($id, $rating)
    {
        return $this->postJson('tv/' . $id . '/rating', ['value' => (float) $rating]);
    }

    /**
     * Get the alternative titles for a specific show ID.
     *
     * @param  integer $id
     * @return mixed
     */
    public function getAlternativeTitles($id)
    {
        return $this->get('tv/' . $id . '/alternative_titles');
    }
}
