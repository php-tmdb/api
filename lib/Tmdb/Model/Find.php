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

namespace Tmdb\Model;

use Tmdb\Model\Collection\People;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class Find.
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
     */
    public function setMovieResults($movieResults): static
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
     */
    public function setPersonResults($personResults): static
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
     */
    public function setTvResults($tvResults): static
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
     */
    public function setTvSeasonResults($tvSeasonResults): static
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
     */
    public function setTvEpisodeResults($tvEpisodeResults): static
    {
        $this->tvEpisodeResults = $tvEpisodeResults;

        return $this;
    }
}
