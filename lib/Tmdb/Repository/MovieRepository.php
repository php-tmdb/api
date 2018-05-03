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

use Tmdb\Factory\ImageFactory;
use Tmdb\Factory\Movie\AlternativeTitleFactory;
use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Video;
use Tmdb\Model\Movie;
use Tmdb\Model\Movie\QueryParameter\AppendToResponse;

/**
 * Class MovieRepository
 * @package Tmdb\Repository
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
     * Load a movie with the given identifier
     *
     * If you want to optimize the result set/bandwidth you
     * should define the AppendToResponse parameter
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function load($id, array $parameters = [], array $headers = [])
    {
        if (!isset($parameters['append_to_response'])) {
            $parameters = array_merge($parameters, [
                new AppendToResponse([
                    AppendToResponse::ALTERNATIVE_TITLES,
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
                ])
            ]);
        }

        $data = $this->getApi()->getMovie($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Get the alternative titles for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return GenericCollection
     */
    public function getAlternativeTitles($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getAlternativeTitles($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['alternative_titles' => $data]);

        return $movie->getAlternativeTitles();
    }

    /**
     * Get the cast and crew information for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getCredits($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getCredits($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['credits' => $data]);

        return $movie->getCredits();
    }

    /**
     * Get the images (posters and backdrops) for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getImages($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getImages($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['images' => $data]);

        return $movie->getImages();
    }

    /**
     * Get the plot keywords for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getKeywords($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getKeywords($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['keywords' => $data]);

        return $movie->getKeywords();
    }

    /**
     * Get the release date and certification information by country for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getReleases($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getReleases($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['releases' => $data]);

        return $movie->getReleases();
    }

    /**
     * Get the translations for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getTranslations($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getTranslations($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['translations' => $data]);

        return $movie->getTranslations();
    }

    /**
     * Get the similar movies for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     *
     * @deprecated Will be removed in one of the upcoming versions, has been updated to getSimilar ( following TMDB ).
     */
    public function getSimilarMovies($id, array $parameters = [], array $headers = [])
    {
        return $this->getSimilar($id, $parameters, $headers);
    }

    /**
     * Get the similar movies for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getSimilar($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getSimilar($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['similar' => $data]);

        return $movie->getSimilar();
    }

    /**
     * Get the recommended movies for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getRecommendations($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getRecommendations($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['recommendations' => $data]);

        return $movie->getRecommendations();
    }

    /**
     * Get the reviews for a particular movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getReviews($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getReviews($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['reviews' => $data]);

        return $movie->getReviews();
    }

    /**
     * Get the lists that the movie belongs to.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getLists($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getLists($id, $this->parseQueryParameters($parameters), $headers);
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
     * @param $id
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getChanges($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getChanges($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['changes' => $data]);

        return $movie->getChanges();
    }

    /**
     * Get the latest movie.
     *
     * @param  array                          $options
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getLatest(array $options = [])
    {
        return $this->getFactory()->create(
            $this->getApi()->getLatest($options)
        );
    }

    /**
     * Get the list of upcoming movies. This list refreshes every day.
     * The maximum number of items this list will include is 100.
     *
     * @param  array   $options
     * @return Movie[]
     */
    public function getUpcoming(array $options = [])
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getUpcoming($options)
        );
    }

    /**
     * Get the list of movies playing in theatres. This list refreshes every day.
     * The maximum number of items this list will include is 100.
     *
     * @param  array   $options
     * @return Movie[]
     */
    public function getNowPlaying(array $options = [])
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getNowPlaying($options)
        );
    }

    /**
     * Get the list of popular movies on The Movie Database.
     * This list refreshes every day.
     *
     * @param  array   $options
     * @return Movie[]
     */
    public function getPopular(array $options = [])
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getPopular($options)
        );
    }

    /**
     * Get the list of top rated movies.
     *
     * By default, this list will only include movies that have 10 or more votes.
     * This list refreshes every day.
     *
     * @param  array   $options
     * @return Movie[]
     */
    public function getTopRated(array $options = [])
    {
        return $this->getFactory()->createResultCollection(
            $this->getApi()->getTopRated($options)
        );
    }

    /**
     * This method lets users get the status of whether or not the movie has been rated
     * or added to their favourite or watch lists. A valid session id is required.
     *
     * @param  integer $id
     * @return Movie[]
     */
    public function getAccountStates($id)
    {
        return $this->getFactory()->createAccountStates(
            $this->getApi()->getAccountStates($id)
        );
    }

    /**
     * This method lets users rate a movie. A valid session id or guest session id is required.
     *
     * @param  integer $id
     * @param  float   $rating
     * @return Movie[]
     */
    public function rate($id, $rating)
    {
        return $this->getFactory()->createResult(
            $this->getApi()->rateMovie($id, $rating)
        );
    }

    /**
     * Get the videos (trailers, teasers, clips, etc...) for a specific movie id.
     *
     * @param $id
     * @param $parameters
     * @param $headers
     * @return Videos|Video[]
     */
    public function getVideos($id, array $parameters = [], array $headers = [])
    {
        $data  = $this->getApi()->getVideos($id, $this->parseQueryParameters($parameters), $headers);
        $movie = $this->getFactory()->create(['videos' => $data]);

        return $movie->getVideos();
    }

    /**
     * Return the Movies API Class
     *
     * @return \Tmdb\Api\Movies
     */
    public function getApi()
    {
        return $this->getClient()->getMoviesApi();
    }

    /**
     * Return the Movie Factory
     *
     * @return MovieFactory
     */
    public function getFactory()
    {
        return new MovieFactory($this->getClient()->getHttpClient());
    }

    /**
     * @param  AlternativeTitleFactory $alternativeTitleFactory
     * @return $this
     */
    public function setAlternativeTitleFactory($alternativeTitleFactory)
    {
        $this->alternativeTitleFactory = $alternativeTitleFactory;

        return $this;
    }

    /**
     * @return AlternativeTitleFactory
     */
    public function getAlternativeTitleFactory()
    {
        return $this->alternativeTitleFactory;
    }

    /**
     * @param  ImageFactory $imageFactory
     * @return $this
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;

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
     * @param  PeopleFactory $peopleFactory
     * @return $this
     */
    public function setPeopleFactory($peopleFactory)
    {
        $this->peopleFactory = $peopleFactory;

        return $this;
    }

    /**
     * @return PeopleFactory
     */
    public function getPeopleFactory()
    {
        return $this->peopleFactory;
    }
}
