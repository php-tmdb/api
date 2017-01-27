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
use Tmdb\Factory\TvSeasonFactory;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\Video;
use \Tmdb\Model\Tv\Season\QueryParameter\AppendToResponse;
use Tmdb\Model\Tv\Season;
use Tmdb\Model\Tv;

/**
 * Class TvSeasonRepository
 * @package Tmdb\Repository
 * @see http://docs.themoviedb.apiary.io/#tvseasons
 */
class TvSeasonRepository extends AbstractRepository
{
    /**
     * Load a tv season with the given identifier
     *
     * If you want to optimize the result set/bandwidth you should define the AppendToResponse parameter
     *
     * @param int|Tv $tvShow
     * @param int|Season $season
     * @param array $parameters
     * @param array $headers
     * @throws RuntimeException
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function load($tvShow, $season, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        if (null === $tvShow || null === $season) {
            throw new RuntimeException('Not all required parameters to load an tv season are present.');
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

        $data = $this->getApi()->getSeason($tvShow, $season, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Get the cast & crew information about a TV series.
     *
     * Just like the website, we pull this information from the last season of the series.
     *
     * @param $tvShow
     * @param $season
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getCredits($tvShow, $season, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        $data   = $this->getApi()->getCredits($tvShow, $season, $this->parseQueryParameters($parameters), $headers);
        $season = $this->getFactory()->create(['credits' => $data]);

        return $season->getCredits();
    }

    /**
     * Get the external ids that we have stored for a TV series.
     *
     * @param $tvShow
     * @param $season
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getExternalIds($tvShow, $season, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        $data   = $this->getApi()->getExternalIds($tvShow, $season, $this->parseQueryParameters($parameters), $headers);
        $season = $this->getFactory()->create(['external_ids' => $data]);

        return $season->getExternalIds();
    }

    /**
     * Get the images (posters and backdrops) for a TV series.
     *
     * @param $tvShow
     * @param $season
     * @param $parameters
     * @param $headers
     * @return null|\Tmdb\Model\AbstractModel
     */
    public function getImages($tvShow, $season, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        $data   = $this->getApi()->getImages($tvShow, $season, $this->parseQueryParameters($parameters), $headers);
        $season = $this->getFactory()->create(['images' => $data]);

        return $season->getImages();
    }

    /**
     * Get the videos that have been added to a TV season (trailers, teasers, etc...)
     *
     * @param $tvShow
     * @param $season
     * @param $parameters
     * @param $headers
     * @return Videos|Video[]
     */
    public function getVideos($tvShow, $season, array $parameters = [], array $headers = [])
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getSeasonNumber();
        }

        $data   = $this->getApi()->getVideos($tvShow, $season, $this->parseQueryParameters($parameters), $headers);
        $season = $this->getFactory()->create(['videos' => $data]);

        return $season->getVideos();
    }

    /**
     * Return the Seasons API Class
     *
     * @return \Tmdb\Api\TvSeason
     */
    public function getApi()
    {
        return $this->getClient()->getTvSeasonApi();
    }

    /**
     * @return TvSeasonFactory
     */
    public function getFactory()
    {
        return new TvSeasonFactory($this->getClient()->getHttpClient());
    }
}
