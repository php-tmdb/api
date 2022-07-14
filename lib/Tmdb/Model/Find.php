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
 * @version 4.0.0
 */

namespace Tmdb\Model;

use Tmdb\Model\Collection\People;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class Find
 * @package Tmdb\Model
 */
class Find extends AbstractModel
{
    /**
     * @var GenericCollection
     */
    private $movieResults;

    /**
     * @var People
     */
    private $personResults;

    /**
     * @var GenericCollection
     */
    private $tvResults;

    /**
     * @var GenericCollection
     */
    private $tvSeasonResults;

    /**
     * @var GenericCollection
     */
    private $tvEpisodeResults;

    /**
     * @return GenericCollection
     */
    public function getMovieResults()
    {
        return $this->movieResults;
    }

    /**
     * @param GenericCollection $movieResults
     * @return self
     */
    public function setMovieResults($movieResults)
    {
        $this->movieResults = $movieResults;

        return $this;
    }

    /**
     * @return People
     */
    public function getPersonResults()
    {
        return $this->personResults;
    }

    /**
     * @param People $personResults
     * @return self
     */
    public function setPersonResults($personResults)
    {
        $this->personResults = $personResults;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTvResults()
    {
        return $this->tvResults;
    }

    /**
     * @param GenericCollection $tvResults
     * @return self
     */
    public function setTvResults($tvResults)
    {
        $this->tvResults = $tvResults;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTvSeasonResults()
    {
        return $this->tvSeasonResults;
    }

    /**
     * @param GenericCollection $tvSeasonResults
     * @return self
     */
    public function setTvSeasonResults($tvSeasonResults)
    {
        $this->tvSeasonResults = $tvSeasonResults;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTvEpisodeResults()
    {
        return $this->tvEpisodeResults;
    }

    /**
     * @param GenericCollection $tvEpisodeResults
     * @return self
     */
    public function setTvEpisodeResults($tvEpisodeResults)
    {
        $this->tvEpisodeResults = $tvEpisodeResults;

        return $this;
    }
}
