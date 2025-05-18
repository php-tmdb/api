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

use Tmdb\Api\Movies;
use Tmdb\Factory\ImageFactory;
use Tmdb\Factory\Movie\AlternativeTitleFactory;
use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Video;
use Tmdb\Model\Keyword;
use Tmdb\Model\Movie;
use Tmdb\Model\Movie\QueryParameter\AppendToResponse;

/**
 * Class MovieRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#movies
 */
class MovieRepository extends AbstractRepository
{
    /**
     * @var ImageFactory
     */
    private $imageFactory;

    /**
     * @var AlternativeTitleFactory
     */
    private $alternativeTitleFactory;

    /**
     * @var PeopleFactory
     */
    private $peopleFactory;

    /**
     * Load a movie with the given identifier.
     *
     * If you want to optimize the result set/bandwidth you
     * should define the AppendToResponse parameter
     *
     * @return AbstractModel|null
     */
    public function load(string $id, array $parameters = [], array $headers = []): ?\Tmdb\Model\Movie
    {
        if (!isset($parameters['append_to_response'])) {
            $parameters = array_merge($parameters, [
                new AppendToResponse([
                    AppendToResponse::ALTERNATIVE_TITLES,
                    AppendToResponse::EXTERNAL_IDS,
                    AppendToResponse::CHANGES,
                    AppendToResponse::CREDITS,
                    AppendToResponse::IMAGES,
                    AppendToResponse::KEYWORDS,
                    AppendToResponse::LISTS,
                    AppendToResponse::RELEASE_DATES,
                    AppendToResponse::REVIEWS,
                    AppendToResponse::SIMILAR,
                    AppendToResponse::RECOMMENDATIONS,
                    AppendToResponse::TRANSLATIONS,
                    AppendToResponse::VIDEOS,
                    AppendToResponse::WATCH_PROVIDERS,
                ]),
            ]);
        }

        $data = $this->getApi()->getMovie($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the Movies API Class.
     *
     * @return Movies
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getMoviesApi();
    }

    /**
     * Return the Movie Factory.
     */
    #[\Override]
    public function getFactory(): \Tmdb\Factory\MovieFactory
    {
        return new MovieFactory($this->getClient()->getHttpClient());
    }

    /**
     * Get the alternative titles for a specific movie id.
     *
     * @return GenericCollection|Movie\AlternativeTitle[]
     *
     * @psalm-return GenericCollection|array<array-key, Movie\AlternativeTitle>
     */
    public function getAlternativeTitles(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getAlternativeTitles($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['alternative_titles' => $data]);

        return $movie->getAlternativeTitles();
    }

    /**
     * Get the cast and crew information for a specific movie id.
     */
    public function getCredits(string $id, array $parameters = [], array $headers = []): CreditsCollection
    {
        $data = $this->getApi()->getCredits($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['credits' => $data]);

        return $movie->getCredits();
    }

    /**
     * Get the images (posters and backdrops) for a specific movie id.
     */
    public function getImages(string $id, array $parameters = [], array $headers = []): Images
    {
        $data = $this->getApi()->getImages($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['images' => $data]);

        return $movie->getImages();
    }

    /**
     * Get the plot keywords for a specific movie id.
     *
     * @return GenericCollection|Keyword[]
     *
     * @psalm-return GenericCollection|array<array-key, Keyword>
     */
    public function getKeywords(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getKeywords($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['keywords' => $data]);

        return $movie->getKeywords();
    }

    /**
     * Get the release date and certification information by country for a specific movie id.
     *
     * @return GenericCollection|Movie\Release[]
     *
     * @psalm-return GenericCollection|array<array-key, Movie\Release>
     */
    public function getReleases(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getReleases($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['releases' => $data]);

        return $movie->getReleases();
    }

    /**
     * Get the translations for a specific movie id.
     */
    public function getTranslations(string $id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getTranslations($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['translations' => $data]);

        return $movie->getTranslations();
    }

    /**
     * Get the similar movies for a specific movie id.
     *
     * @deprecated will be removed in one of the upcoming versions, has been updated to getSimilar ( following TMDB )
     */
    public function getSimilarMovies($id, array $parameters = [], array $headers = []): GenericCollection
    {
        return $this->getSimilar($id, $parameters, $headers);
    }

    /**
     * Get the similar movies for a specific movie id.
     */
    public function getSimilar(string $id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getSimilar($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['similar' => $data]);

        return $movie->getSimilar();
    }

    /**
     * Get the recommended movies for a specific movie id.
     */
    public function getRecommendations(string $id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getRecommendations($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['recommendations' => $data]);

        return $movie->getRecommendations();
    }

    /**
     * Get the reviews for a particular movie id.
     */
    public function getReviews(string $id, array $parameters = [], array $headers = []): ResultCollection
    {
        $data = $this->getApi()->getReviews($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['reviews' => $data]);

        return $movie->getReviews();
    }

    /**
     * Get the lists that the movie belongs to.
     */
    public function getLists(string $id, array $parameters = [], array $headers = []): GenericCollection
    {
        $data = $this->getApi()->getLists($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['lists' => $data]);

        return $movie->getLists();
    }

    /**
     * Get the changes for a specific movie id.
     * Changes are grouped by key, and ordered by date in descending order.
     *
     * By default, only the last 24 hours of changes are returned.
     * The maximum number of days that can be returned in a single request is 14.
     *
     * The language is present on fields that are translatable.
     *
     * @return GenericCollection
     */
    public function getChanges(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getChanges($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['changes' => $data]);

        return $movie->getChanges();
    }

    /**
     * Get the latest movie.
     *
     * @return AbstractModel|null
     */
    public function getLatest(array $options = []): ?\Tmdb\Model\Movie
    {
        return $this->getFactory()->create(
            $this->getApi()->getLatest($options),
        );
    }

    /**
     * Get the list of upcoming movies. This list refreshes every day.
     * The maximum number of items this list will include is 100.
     */
    public function getUpcoming(array $options = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getUpcoming($options),
        );
    }

    /**
     * Get the list of movies playing in theatres. This list refreshes every day.
     * The maximum number of items this list will include is 100.
     */
    public function getNowPlaying(array $options = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getNowPlaying($options),
        );
    }

    /**
     * Get the list of popular movies on The Movie Database.
     * This list refreshes every day.
     */
    public function getPopular(array $options = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getPopular($options),
        );
    }

    /**
     * Get the list of top rated movies.
     *
     * By default, this list will only include movies that have 10 or more votes.
     * This list refreshes every day.
     */
    public function getTopRated(array $options = []): ResultCollection
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getTopRated($options),
        );
    }

    /**
     * This method lets users get the status of whether or not the movie has been rated
     * or added to their favourite or watch lists. A valid session id is required.
     *
     * @param int $id
     */
    public function getAccountStates($id): AbstractModel
    {
        return $this->getFactory()->createAccountStates(
            $this->getApi()->getAccountStates($id),
        );
    }

    /**
     * This method lets users rate a movie. A valid session id or guest session id is required.
     *
     * @param int   $id
     * @param float $rating
     */
    public function rate($id, $rating): AbstractModel
    {
        return $this->getFactory()->createResult(
            $this->getApi()->rateMovie($id, $rating),
        );
    }

    /**
     * Get the videos (trailers, teasers, clips, etc...) for a specific movie id.
     *
     * @return Videos|Video[]
     */
    public function getVideos(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getVideos($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['videos' => $data]);

        return $movie->getVideos();
    }

    /**
     * Get the watch providers (by region) for a specific movie id.
     *
     * @return GenericCollection
     */
    public function getWatchProviders(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getWatchProviders($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['watch/providers' => $data]);

        return $movie->getWatchProviders();
    }

    /**
     * Get the external ids that we have stored for a movie.
     *
     * @return AbstractModel|null
     */
    public function getExternalIds(string $id, array $parameters = [], array $headers = [])
    {
        $data = $this->getApi()->getExternalIds($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['external_ids' => $data]);

        return $movie->getExternalIds();
    }

    /**
     * @return AlternativeTitleFactory
     */
    public function getAlternativeTitleFactory()
    {
        return $this->alternativeTitleFactory;
    }

    /**
     * @param AlternativeTitleFactory $alternativeTitleFactory
     */
    public function setAlternativeTitleFactory($alternativeTitleFactory): static
    {
        $this->alternativeTitleFactory = $alternativeTitleFactory;

        return $this;
    }

    /**
     * @return ImageFactory
     */
    public function getImageFactory()
    {
        return $this->imageFactory;
    }

    /**
     * @param ImageFactory $imageFactory
     */
    public function setImageFactory($imageFactory): static
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }

    /**
     * @return PeopleFactory
     */
    public function getPeopleFactory()
    {
        return $this->peopleFactory;
    }

    /**
     * @param PeopleFactory $peopleFactory
     */
    public function setPeopleFactory($peopleFactory): static
    {
        $this->peopleFactory = $peopleFactory;

        return $this;
    }
}
