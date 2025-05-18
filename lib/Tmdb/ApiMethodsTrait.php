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

namespace Tmdb;

trait ApiMethodsTrait
{
    public function getAccountApi(): \Tmdb\Api\Account
    {
        return new Api\Account($this);
    }

    public function getAuthenticationApi(): \Tmdb\Api\Authentication
    {
        return new Api\Authentication($this);
    }

    public function getCertificationsApi(): \Tmdb\Api\Certifications
    {
        return new Api\Certifications($this);
    }

    public function getChangesApi(): \Tmdb\Api\Changes
    {
        return new Api\Changes($this);
    }

    public function getCollectionsApi(): \Tmdb\Api\Collections
    {
        return new Api\Collections($this);
    }

    public function getCompaniesApi(): \Tmdb\Api\Companies
    {
        return new Api\Companies($this);
    }

    public function getConfigurationApi(): \Tmdb\Api\Configuration
    {
        return new Api\Configuration($this);
    }

    public function getCreditsApi(): \Tmdb\Api\Credits
    {
        return new Api\Credits($this);
    }

    public function getDiscoverApi(): \Tmdb\Api\Discover
    {
        return new Api\Discover($this);
    }

    public function getFindApi(): \Tmdb\Api\Find
    {
        return new Api\Find($this);
    }

    public function getGenresApi(): \Tmdb\Api\Genres
    {
        return new Api\Genres($this);
    }

    public function getGuestSessionApi(): \Tmdb\Api\GuestSession
    {
        return new Api\GuestSession($this);
    }

    public function getJobsApi(): \Tmdb\Api\Jobs
    {
        return new Api\Jobs($this);
    }

    public function getKeywordsApi(): \Tmdb\Api\Keywords
    {
        return new Api\Keywords($this);
    }

    public function getListsApi(): \Tmdb\Api\Lists
    {
        return new Api\Lists($this);
    }

    public function getMoviesApi(): \Tmdb\Api\Movies
    {
        return new Api\Movies($this);
    }

    public function getNetworksApi(): \Tmdb\Api\Networks
    {
        return new Api\Networks($this);
    }

    public function getPeopleApi(): \Tmdb\Api\People
    {
        return new Api\People($this);
    }

    public function getReviewsApi(): \Tmdb\Api\Reviews
    {
        return new Api\Reviews($this);
    }

    public function getSearchApi(): \Tmdb\Api\Search
    {
        return new Api\Search($this);
    }

    public function getTimezonesApi(): \Tmdb\Api\Timezones
    {
        return new Api\Timezones($this);
    }

    public function getTvApi(): \Tmdb\Api\Tv
    {
        return new Api\Tv($this);
    }

    public function getTvSeasonApi(): \Tmdb\Api\TvSeason
    {
        return new Api\TvSeason($this);
    }

    public function getTvEpisodeApi(): \Tmdb\Api\TvEpisode
    {
        return new Api\TvEpisode($this);
    }

    public function getTvEpisodeGroupApi(): \Tmdb\Api\TvEpisodeGroup
    {
        return new Api\TvEpisodeGroup($this);
    }
}
