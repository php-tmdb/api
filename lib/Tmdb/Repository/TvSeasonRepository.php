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

use \RuntimeException;

use Tmdb\Factory\TvSeasonFactory;
use Tmdb\Model\Common\Collection;

use \Tmdb\Model\Tv\Season\QueryParameter\AppendToResponse;
use Tmdb\Model\Tv\Season;
use Tmdb\Model\Tv;

class TvSeasonRepository extends AbstractRepository {

    /**
     * Load a tv season with the given identifier
     *
     * If you want to optimize the result set/bandwidth you should define the AppendToResponse parameter
     *
     * @param $tvShow
     * @param $season
     * @param $parameters
     * @param $headers
     * @throws RuntimeException
     * @return Season
     */
    public function load($tvShow, $season, array $parameters = array(), array $headers = array())
    {
        if ($tvShow instanceof Tv) {
            $tvShow = $tvShow->getId();
        }

        if ($season instanceof Season) {
            $season = $season->getId();
        }

        if (null == $tvShow || null == $season) {
            throw new RuntimeException('Not all required parameters to load an tv season are present.');
        }

        if (empty($parameters)) {
            $parameters = array(
                new AppendToResponse(array(
                    AppendToResponse::CREDITS,
                    AppendToResponse::EXTERNAL_IDS,
                    AppendToResponse::IMAGES,
                ))
            );
        }

        $data = $this->getApi()->getSeason($tvShow, $season, $this->parseQueryParameters($parameters), $this->parseHeaders($headers));

        return TvSeasonFactory::create($data);
    }

    /**
     * If you obtained an season model which is not completely hydrated, you can use this function.
     *
     * @param Season $season
     * @param array $parameters
     * @param array $headers
     * @return Season
     */
    public function refresh(Season $season, array $parameters = array(), array $headers = array())
    {
        return $this->load($season->getId(), $parameters, $headers);
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
     * Create an collection of an array
     *
     * @todo Allow an array of Season objects to pass ( custom collection )
     *
     * @param $data
     * @return Collection
     */
    private function createCollection($data){
        $collection = new Collection();

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach($data as $item) {
            $collection->add(null, TvSeasonFactory::create($item));
        }

        return $collection;
    }

}