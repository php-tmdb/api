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

use Tmdb\Exception\NotImplementedException;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Credits;
use Tmdb\Model\Person;

/**
 * Class CreditsFactory.
 *
 * @extends AbstractFactory<Credits>
 */
class CreditsFactory extends AbstractFactory
{
    /**
     * @var PeopleFactory|mixed
     */
    private $peopleFactory;

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
        $this->tvSeasonFactory = new TvSeasonFactory($httpClient);
        $this->tvEpisodeFactory = new TvEpisodeFactory($httpClient);
        $this->peopleFactory = new PeopleFactory($httpClient);

        parent::__construct($httpClient);
    }

    #[\Override]
    public function create(array $data = []): Credits
    {
        $credits = new Credits();

        if (\array_key_exists('media', $data)) {
            $credits->setMedia(
                $this->hydrate($credits->getMedia(), $data['media']),
            );

            if (\array_key_exists('seasons', $data['media'])) {
                $episodes = $this->getTvSeasonFactory()->createCollection($data['media']['seasons']);
                $credits->getMedia()->setSeasons($episodes);
            }

            if (\array_key_exists('episodes', $data['media'])) {
                $episodes = $this->getTvEpisodeFactory()->createCollection($data['media']['episodes']);
                $credits->getMedia()->setEpisodes($episodes);
            }
        }

        if (\array_key_exists('person', $data)) {
            $person = $this->getPeopleFactory()->create($data['person']);

            $credits->setPerson($person);
        }

        return $this->hydrate($credits, $data);
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

    /**
     * @return PeopleFactory<Person>
     */
    public function getPeopleFactory()
    {
        return $this->peopleFactory;
    }

    /**
     * @param PeopleFactory<Person> $peopleFactory
     */
    public function setPeopleFactory($peopleFactory): static
    {
        $this->peopleFactory = $peopleFactory;

        return $this;
    }

    /**
     * @throws NotImplementedException
     */
    #[\Override]
    public function createCollection(array $data = []): void
    {
        throw new NotImplementedException('Credits are usually obtained through the PeopleFactory,
            however we might add a shortcut for that here.');
    }
}
