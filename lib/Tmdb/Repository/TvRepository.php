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

namespace Tmdb\Repository;

use Tmdb\Factory\TvFactory;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\AccountStates;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Video;
use Tmdb\Model\Lists\Result;
use Tmdb\Model\Tv;
use Tmdb\Model\Tv\QueryParameter\AppendToResponse;

/**
 * Class TvRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#tv
 */
class TvRepository extends AbstractRepository
{
    /**
     * Load a tv with the given identifier.
     *
     * If you want to optimize the result set/bandwidth you should
     * define the AppendToResponse parameter
     *
     * @param int $id
     *
     * @return AbstractModel|null
     */
    public function load($id, array $parameters = [], array $headers = []): ?\Tmdb\Model\Tv
    {
        if (!isset($parameters['append_to_response'])) {
            $parameters = array_merge($parameters, [
                new AppendToResponse([
                    AppendToResponse::CREDITS,
                    AppendToResponse::EXTERNAL_IDS,
                    AppendToResponse::IMAGES,
                    AppendToResponse::TRANSLATIONS,
                    AppendToResponse::SIMILAR,
                    AppendToResponse::RECOMMENDATIONS,
                    AppendToResponse::KEYWORDS,
                    AppendToResponse::CHANGES,
                    AppendToResponse::CONTENT_RATINGS,
                    AppendToResponse::ALTERNATIVE_TITLES,
                    AppendToResponse::VIDEOS,
                    AppendToResponse::WATCH_PROVIDERS,
                    AppendToResponse::EPISODE_GROUPS,
                ]),
            ]);
        }

        $data = $this->getApi()->getTvshow($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the Tvs API Class.
     *
     * @return \Tmdb\Api\Tv
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getTvApi();
    }

    #[\Override]
    public function getFactory(): \Tmdb\Factory\TvFactory
    {
        return new TvFactory($this->getClient()->getHttpClient());
    }

    /**
     * Get the cast & crew information about a TV series.
     *
     * Just like the website, we pull this information from the last season of the series.
     */
    public function getCredits(string $id, array $parameters = [], array $headers = []): CreditsCollection
    {
        $data = $this->getApi()->getCredits($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['credits' => $data]);

        \assert($tv instanceof Tv);

        return $tv->getCredits();
    }

    /**
     * Get the content ratings for a specific TV show id.
     */
    public function getContentRatings(string $id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getContentRatings($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['content_ratings' => $data]);

        return $tv->getContentRatings();
    }

    /**
     * Get the external ids that we have stored for a TV series.
     *
     * @return AbstractModel|null
     */
    public function getExternalIds(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getExternalIds($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['external_ids' => $data]);

        return $tv->getExternalIds();
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     */
    public function getImages(string $id, array $parameters = [], array $headers = []): Images
    {
        $data = $this->getApi()->getImages($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['images' => $data]);

        return $tv->getImages();
    }

    /**
     * Get the similar TV shows for a specific TV show id.
     */
    public function getSimilar(string $id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getSimilar($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['similar' => $data]);

        return $movie->getSimilar();
    }

    /**
     * Get the recommended TV shows for a specific movie id.
     */
    public function getRecommendations(string $id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getRecommendations($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['recommendations' => $data]);

        return $movie->getRecommendations();
    }

    /**
     * Get the list of translations that exist for a TV series.
     *
     * These translations cascade down to the episode level.
     */
    public function getTranslations($id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getTranslations($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['translations' => $data]);

        return $tv->getTranslations();
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     *
     * @return Videos|Video[]
     */
    public function getVideos($id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getVideos($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['videos' => $data]);

        return $tv->getVideos();
    }

    /**
     * Get the watch providers (by region) for a TV series.
     *
     * @return GenericCollection
     */
    public function getWatchProviders(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getWatchProviders($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['watch/providers' => $data]);

        return $tv->getWatchProviders();
    }

    /**
     * Get the alternative titles for a specific show ID.
     *
     * @return GenericCollection|Tv\AlternativeTitle[]
     */
    public function getAlternativeTitles($id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getAlternativeTitles($id, $this->parseQueryParameters($parameters), $headers);
        $tv = $this->getFactory()->create(['alternative_titles' => $data]);

        return $tv->getAlternativeTitles();
    }

    /**
     * Get the list of popular tvs on The Tv Database. This list refreshes every day.
     */
    public function getPopular(array $options = [], array $headers = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getPopular($options, $headers),
        );
    }

    /**
     * Get the list of top rated tvs. By default, this list will only include tvs that have 10 or more votes.
     * This list refreshes every day.
     */
    public function getTopRated(array $options = [], array $headers = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getTopRated($options, $headers),
        );
    }

    /**
     * Get the list of top rated tvs. By default, this list will only include tvs that have 10 or more votes.
     * This list refreshes every day.
     */
    public function getOnTheAir(array $options = [], array $headers = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getOnTheAir($options, $headers),
        );
    }

    /**
     * Get the list of TV shows that air today.
     *
     * Without a specified timezone, this query defaults to EST (Eastern Time UTC-05:00).
     */
    public function getAiringToday(array $options = [], array $headers = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getAiringToday($options, $headers),
        );
    }

    /**
     * Get the latest tv-show.
     *
     * @return AbstractModel|null
     */
    public function getLatest(array $options = []): ?\Tmdb\Model\Tv
    {
        return $this->getFactory()->create(
            $this->getApi()->getLatest($options),
        );
    }

    /**
     * This method lets users get the status of whether or not the TV show has been rated
     * or added to their favourite or watch lists.
     *
     * A valid session id is required.
     *
     * @param int $id
     *
     * @return AccountStates
     */
    public function getAccountStates($id)
    {
        return $this->getFactory()->createAccountStates(
            $this->getApi()->getAccountStates($id),
        );
    }

    /**
     * This method lets users rate a TV show.
     *
     * A valid session id or guest session id is required.
     *
     * @param int   $id
     * @param float $rating
     *
     * @return Result
     */
    public function rate($id, $rating)
    {
        return $this->getFactory()->createResult(
            $this->getApi()->rateTvShow($id, $rating),
        );
    }
}
