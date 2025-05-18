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

namespace Tmdb\Factory;

use RuntimeException;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Find;

/**
 * Class FindFactory.
 */
class FindFactory extends AbstractFactory
{
    /**
     * @var MovieFactory|mixed
     */
    private $movieFactory;

    /**
     * @var PeopleFactory|mixed
     */
    private $peopleFactory;

    /**
     * @var TvFactory|mixed
     */
    private $tvFactory;

    /**
     * @var TvSeasonFactory|mixed
     */
    private $tvSeasonFactory;

    /**
     * @var TvEpisodeFactory|mixed
     */
    private $tvEpisodeFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->movieFactory = new MovieFactory($httpClient);
        $this->peopleFactory = new PeopleFactory($httpClient);
        $this->tvFactory = new TvFactory($httpClient);
        $this->tvSeasonFactory = new TvSeasonFactory($httpClient);
        $this->tvEpisodeFactory = new TvEpisodeFactory($httpClient);

        parent::__construct($httpClient);
    }

    #[\Override]
    public function create(array $data = []): Find
    {
        $find = new Find();

        if (\array_key_exists('movie_results', $data)) {
            $find->setMovieResults($this->getMovieFactory()->createCollection($data['movie_results']));
        }

        if (\array_key_exists('person_results', $data)) {
            $find->setPersonResults($this->getPeopleFactory()->createCollection($data['person_results']));
        }

        if (\array_key_exists('tv_results', $data)) {
            $find->setTvResults($this->getTvFactory()->createCollection($data['tv_results']));
        }

        if (\array_key_exists('tv_season_results', $data)) {
            $find->setTvSeasonResults($this->getTvSeasonFactory()->createCollection($data['tv_season_results']));
        }

        if (\array_key_exists('tv_episode_results', $data)) {
            $find->setTvEpisodeResults($this->getTvEpisodeFactory()->createCollection($data['tv_episode_results']));
        }

        return $find;
    }

    /**
     * @return MovieFactory
     */
    public function getMovieFactory()
    {
        return $this->movieFactory;
    }

    /**
     * @param MovieFactory $movieFactory
     */
    public function setMovieFactory($movieFactory): static
    {
        $this->movieFactory = $movieFactory;

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

    /**
     * @return TvFactory
     */
    public function getTvFactory()
    {
        return $this->tvFactory;
    }

    /**
     * @param TvFactory $tvFactory
     */
    public function setTvFactory($tvFactory): static
    {
        $this->tvFactory = $tvFactory;

        return $this;
    }

    /**
     * @return TvSeasonFactory
     */
    public function getTvSeasonFactory()
    {
        return $this->tvSeasonFactory;
    }

    /**
     * @param TvSeasonFactory $tvSeasonFactory
     */
    public function setTvSeasonFactory($tvSeasonFactory): static
    {
        $this->tvSeasonFactory = $tvSeasonFactory;

        return $this;
    }

    /**
     * @return TvEpisodeFactory
     */
    public function getTvEpisodeFactory()
    {
        return $this->tvEpisodeFactory;
    }

    /**
     * @param TvEpisodeFactory $tvEpisodeFactory
     */
    public function setTvEpisodeFactory($tvEpisodeFactory): static
    {
        $this->tvEpisodeFactory = $tvEpisodeFactory;

        return $this;
    }

    #[\Override]
    public function createCollection(array $data = []): void
    {
        throw new RuntimeException(\sprintf('Class "%s" does not support method "%s".', self::class, __METHOD__));
    }
}
