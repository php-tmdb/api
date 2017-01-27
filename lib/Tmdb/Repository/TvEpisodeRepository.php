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

use Tmdb\Exception\RuntimeException;
use Tmdb\Factory\TvEpisodeFactory;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\AccountStates;
use Tmdb\Model\Common\Video;
use Tmdb\Model\Lists\Result;
use Tmdb\Model\Tv\Episode\QueryParameter\AppendToResponse;
use Tmdb\Model\Tv;
use Tmdb\Model\Tv\Season;
use Tmdb\Model\Tv\Episode;

/**
 * Class TvEpisodeRepository
 * @package Tmdb\Repository
 * @see http://docs.themoviedb.apiary.io/#tvepisodes
 */
class TvEpisodeRepository extends AbstractRepository
{
    /**
     * Load a tv season with the given identifier
     *
     * If you want to optimize the result set/bandwidth you should
     * define the AppendToResponse parameter
     *
     * @param $tvShow Tv|integer
     * @param $season Season|integer
     * @param $episode Episode|integer
     * @param $parameters
     * @param $headers
     * @throws RuntimeException
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function load($tvShow, $season, $episode, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if ($episode instanceof Tv\Episode) {
            $episode = $episode->getEpisodeNumber();
        }

        if (is_null($tvShow) || is_null($season) || is_null($episode) ) {
            throw new RuntimeException('Not all required parameters to load an tv episode are present.');
        }

        if (!isset($parameters['append_to_response'])) {
            $parameters = array_merge($parameters, [
                new AppendToResponse([
                    AppendToResponse::CREDITS,
                    AppendToResponse::EXTERNAL_IDS,
                    AppendToResponse::IMAGES,
                    AppendToResponse::CHANGES,
                    AppendToResponse::VIDEOS
                ])
            ]);
        }

        $data = $this->getApi()->getEpisode(
            $tvShow,
            $season,
            $episode,
            $this->parseQueryParameters($parameters),
            $headers
        );

        return $this->getFactory()->create($data);
    }

    /**
     * Get the cast & crew information about a TV series.
     *
     * Just like the website, we pull this information from the last season of the series.
     *
     * @param $tvShow
     * @param $season
     * @param $episode
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getCredits($tvShow, $season, $episode, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if ($episode instanceof Tv\Episode) {
            $episode = $episode->getEpisodeNumber();
        }

        $data = $this->getApi()->getCredits(
            $tvShow,
            $season,
            $episode,
            $this->parseQueryParameters($parameters),
            $headers
        );

        $episode = $this->getFactory()->create(['credits' => $data]);

        return $episode->getCredits();
    }

    /**
     * Get the external ids that we have stored for a TV series.
     *
     * @param $tvShow
     * @param $season
     * @param $episode
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getExternalIds($tvShow, $season, $episode, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if ($episode instanceof Tv\Episode) {
            $episode = $episode->getEpisodeNumber();
        }

        $data = $this->getApi()->getExternalIds(
            $tvShow,
            $season,
            $episode,
            $this->parseQueryParameters($parameters),
            $headers
        );

        $episode = $this->getFactory()->create(['external_ids' => $data]);

        return $episode->getExternalIds();
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     *
     * @param $tvShow
     * @param $season
     * @param $episode
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getImages($tvShow, $season, $episode, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if ($episode instanceof Tv\Episode) {
            $episode = $episode->getEpisodeNumber();
        }

        $data = $this->getApi()->getImages(
            $tvShow,
            $season,
            $episode,
            $this->parseQueryParameters($parameters),
            $headers
        );

        $episode = $this->getFactory()->create(['images' => $data]);

        return $episode->getImages();
    }

    /**
     * Get the videos that have been added to a TV episode (teasers, clips, etc...)
     *
     * @param $tvShow
     * @param $season
     * @param $episode
     * @param $parameters
     * @param $headers
     * @return Videos|Video[]
     */
    public function getVideos($tvShow, $season, $episode, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if ($episode instanceof Tv\Episode) {
            $episode = $episode->getEpisodeNumber();
        }

        $data = $this->getApi()->getVideos(
            $tvShow,
            $season,
            $episode,
            $this->parseQueryParameters($parameters),
            $headers
        );

        $episode = $this->getFactory()->create(['videos' => $data]);

        return $episode->getVideos();
    }

    /**
     * This method lets users get the status of whether or not the TV show has been rated
     * or added to their favourite or watch lists.
     *
     * A valid session id is required.
     *
     * @param  mixed         $tvShow
     * @param  mixed         $season
     * @param  mixed         $episode
     * @return AccountStates
     */
    public function getAccountStates($tvShow, $season, $episode)
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if ($episode instanceof Tv\Episode) {
            $episode = $episode->getEpisodeNumber();
        }

        return $this->getFactory()->createAccountStates(
            $this->getApi()->getAccountStates($tvShow, $season, $episode)
        );
    }

    /**
     * This method lets users rate a TV show.
     *
     * A valid session id or guest session id is required.
     *
     * @param  mixed  $tvShow
     * @param  mixed  $season
     * @param  mixed  $episode
     * @param  double $rating
     * @return Result
     */
    public function rate($tvShow, $season, $episode, $rating)
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if ($episode instanceof Tv\Episode) {
            $episode = $episode->getEpisodeNumber();
        }

        return $this->getFactory()->createResult(
            $this->getApi()->rateTvEpisode($tvShow, $season, $episode, $rating)
        );
    }

    /**
     * Return the Seasons API Class
     *
     * @return \Tmdb\Api\TvEpisode
     */
    public function getApi()
    {
        return $this->getClient()->getTvEpisodeApi();
    }

    /**
     * @return TvEpisodeFactory
     */
    public function getFactory()
    {
        return new TvEpisodeFactory($this->getClient()->getHttpClient());
    }
}
