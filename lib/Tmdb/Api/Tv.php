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
 * Class Tv.
 *
 * @see http://docs.themoviedb.apiary.io/#tv
 */
class Tv extends AbstractApi
{
    /**
     * Get the primary information about a TV series by id.
     *
     * @param int $tvshow_id
     */
    public function getTvshow($tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id, $parameters, $headers);
    }

    /**
     * Get the cast & crew information about a TV series.
     * Just like the website, we pull this information from the last season of the series.
     */
    public function getCredits(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/credits', $parameters, $headers);
    }

    /**
     * Get the content ratings for a specific TV show id.
     */
    public function getContentRatings(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/content_ratings', $parameters, $headers);
    }

    /**
     * Get the external ids that we have stored for a TV series.
     */
    public function getExternalIds(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/external_ids', $parameters, $headers);
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     */
    public function getImages(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/images', $parameters, $headers);
    }

    /**
     * Get the list of popular TV shows. This list refreshes every day.
     */
    public function getPopular(array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/popular', $parameters, $headers);
    }

    /**
     * Get the list of top rated TV shows.
     *
     * By default, this list will only include TV shows that have 2 or more votes.
     * This list refreshes every day.
     */
    public function getTopRated(array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/top_rated', $parameters, $headers);
    }

    /**
     * Get the list of translations that exist for a TV series.
     *
     * These translations cascade down to the episode level.
     *
     * @param int $tvshow_id
     */
    public function getTranslations($tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/translations', $parameters, $headers);
    }

    /**
     * Get the list of TV shows that are currently on the air.
     *
     * This query looks for any TV show that has an episode with an air date in the next 7 days.
     */
    public function getOnTheAir(array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/on_the_air', $parameters, $headers);
    }

    /**
     * Get the list of TV shows that air today.
     *
     * Without a specified timezone, this query defaults to EST (Eastern Time UTC-05:00).
     */
    public function getAiringToday(array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/airing_today', $parameters, $headers);
    }

    /**
     * Get the videos that have been added to a TV series (trailers, opening credits, etc...).
     *
     * @param int $tvshow_id
     */
    public function getVideos($tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/videos', $parameters, $headers);
    }

    /**
     * Get the watch providers (by region) for a specific movie id.
     */
    public function getWatchProviders(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/watch/providers', $parameters, $headers);
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
     */
    public function getChanges(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/changes', $parameters, $headers);
    }

    /**
     * Get the latest TV show id.
     */
    public function getLatest(array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/latest', $parameters, $headers);
    }

    /**
     * Get the plot keywords for a specific TV show id.
     */
    public function getKeywords(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/keywords', $parameters, $headers);
    }

    /**
     * Get the similar TV shows for a specific tv id.
     */
    public function getSimilar(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/similar', $parameters, $headers);
    }

    /**
     * Get the recommended TV shows for a specific tv id.
     */
    public function getRecommendations(string $tvshow_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $tvshow_id . '/recommendations', $parameters, $headers);
    }

    /**
     * This method lets users get the status of whether or not the TV show has been rated
     * or added to their favourite or watch lists.
     *
     * A valid session id is required.
     *
     * @param int $id
     */
    public function getAccountStates($id): array
    {
        return $this->get('tv/' . $id . '/account_states');
    }

    /**
     * This method lets users rate a TV show.
     *
     * A valid session id or guest session id is required.
     *
     * @param int   $id
     * @param float $rating
     */
    public function rateTvShow($id, $rating): array
    {
        return $this->postJson('tv/' . $id . '/rating', ['value' => (float) $rating]);
    }

    /**
     * Get the alternative titles for a specific show ID.
     *
     * @param int $id
     */
    public function getAlternativeTitles($id, array $parameters = [], array $headers = []): array
    {
        return $this->get('tv/' . $id . '/alternative_titles', $parameters, $headers);
    }

    /**
     * Get the alternative titles for a specific show ID.
     *
     * @param int $id
     */
    public function getEpisodeGroups($id): array
    {
        return $this->get('tv/' . $id . '/episode_groups');
    }
}
