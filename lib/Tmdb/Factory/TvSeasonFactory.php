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

use Tmdb\Factory\Common\ChangeFactory;
use Tmdb\Factory\Common\VideoFactory;
use Tmdb\Factory\People\CastFactory;
use Tmdb\Factory\People\CrewFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;
use Tmdb\Model\Tv\Season;

/**
 * Class TvSeasonFactory.
 *
 * @extends AbstractFactory<Season>
 */
class TvSeasonFactory extends AbstractFactory
{
    /**
     * @var CastFactory|mixed
     */
    private $castFactory;

    /**
     * @var CrewFactory|mixed
     */
    private $crewFactory;

    /**
     * @var ImageFactory|mixed
     */
    private $imageFactory;

    /**
     * @var TvEpisodeFactory|mixed
     */
    private $tvEpisodeFactory;

    /**
     * @var VideoFactory|mixed
     */
    private $videoFactory;

    /**
     * @var ChangeFactory|mixed
     */
    private $changesFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->castFactory = new CastFactory($httpClient);
        $this->crewFactory = new CrewFactory($httpClient);
        $this->imageFactory = new ImageFactory($httpClient);
        $this->tvEpisodeFactory = new TvEpisodeFactory($httpClient);
        $this->videoFactory = new VideoFactory($httpClient);
        $this->changesFactory = new ChangeFactory($httpClient);

        parent::__construct($httpClient);
    }

    #[\Override]
    public function createCollection(array $data = []): \Tmdb\Model\Common\GenericCollection
    {
        /** @var GenericCollection<Season> */
        $collection = new GenericCollection();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): ?Season
    {
        if ($data === []) {
            return null;
        }

        $tvSeason = new Season();

        if (\array_key_exists('credits', $data)) {
            if (\array_key_exists('cast', $data['credits']) && null !== $data['credits']['cast']) {
                $tvSeason->getCredits()->setCast(
                    $this->getCastFactory()->createCollection(
                        $data['credits']['cast'],
                        new CastMember(),
                    ),
                );
            }

            if (\array_key_exists('crew', $data['credits']) && null !== $data['credits']['crew']) {
                $tvSeason->getCredits()->setCrew(
                    $this->getCrewFactory()->createCollection(
                        $data['credits']['crew'],
                        new CrewMember(),
                    ),
                );
            }
        }

        /* External ids */
        if (\array_key_exists('external_ids', $data) && null !== $data['external_ids']) {
            $tvSeason->setExternalIds(
                $this->hydrate(new ExternalIds(), $data['external_ids']),
            );
        }

        /* Images */
        if (\array_key_exists('images', $data) && null !== $data['images']) {
            $tvSeason->setImages($this->getImageFactory()->createCollectionFromTvSeason($data['images']));
        }

        if (\array_key_exists('poster_path', $data)) {
            $tvSeason->setPosterImage($this->getImageFactory()->createFromPath($data['poster_path'], 'poster_path'));
        }

        /* Episodes */
        if (\array_key_exists('episodes', $data) && null !== $data['episodes']) {
            $tvSeason->setEpisodes($this->getTvEpisodeFactory()->createCollection($data['episodes']));
        }

        if (\array_key_exists('videos', $data) && null !== $data['videos']) {
            $tvSeason->setVideos($this->getVideoFactory()->createCollection($data['videos']));
        }

        if (\array_key_exists('changes', $data) && null !== $data['changes']) {
            $tvSeason->setChanges($this->getChangesFactory()->createCollection($data['changes']));
        }

        return $this->hydrate($tvSeason, $data);
    }

    /**
     * @return CastFactory
     */
    public function getCastFactory()
    {
        return $this->castFactory;
    }

    /**
     * @param CastFactory $castFactory
     */
    public function setCastFactory($castFactory): static
    {
        $this->castFactory = $castFactory;

        return $this;
    }

    /**
     * @return CrewFactory
     */
    public function getCrewFactory()
    {
        return $this->crewFactory;
    }

    /**
     * @param CrewFactory $crewFactory
     */
    public function setCrewFactory($crewFactory): static
    {
        $this->crewFactory = $crewFactory;

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
     * @return VideoFactory
     */
    public function getVideoFactory()
    {
        return $this->videoFactory;
    }

    /**
     * @param VideoFactory $videoFactory
     */
    public function setVideoFactory($videoFactory): static
    {
        $this->videoFactory = $videoFactory;

        return $this;
    }

    /**
     * @return ChangeFactory
     */
    public function getChangesFactory()
    {
        return $this->changesFactory;
    }

    /**
     * @param ChangeFactory $changesFactory
     */
    public function setChangesFactory($changesFactory): static
    {
        $this->changesFactory = $changesFactory;

        return $this;
    }
}
