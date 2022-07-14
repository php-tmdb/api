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

namespace Tmdb\Factory;

use Tmdb\Factory\Common\ChangeFactory;
use Tmdb\Factory\Common\VideoFactory;
use Tmdb\Factory\People\CastFactory;
use Tmdb\Factory\People\CrewFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\Country;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\SpokenLanguage;
use Tmdb\Model\Common\Translation;
use Tmdb\Model\Company;
use Tmdb\Model\Network;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;
use Tmdb\Model\Tv;
use Tmdb\Model\Watch;

/**
 * Class TvFactory
 * @package Tmdb\Factory
 */
class TvFactory extends AbstractFactory
{
    /**
     * @var People\CastFactory
     */
    private $castFactory;

    /**
     * @var People\CrewFactory
     */
    private $crewFactory;

    /**
     * @var GenreFactory
     */
    private $genreFactory;

    /**
     * @var ImageFactory
     */
    private $imageFactory;

    /**
     * @var TvSeasonFactory
     */
    private $tvSeasonFactory;

    /**
     * @var TvEpisodeFactory
     */
    private $tvEpisodeFactory;

    /**
     * @var NetworkFactory
     */
    private $networkFactory;

    /**
     * @var Common\VideoFactory
     */
    private $videoFactory;

    /**
     * @var ChangeFactory
     */
    private $changesFactory;

    /**
     * @var KeywordFactory
     */
    private $keywordFactory;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->castFactory = new CastFactory($httpClient);
        $this->crewFactory = new CrewFactory($httpClient);
        $this->genreFactory = new GenreFactory($httpClient);
        $this->imageFactory = new ImageFactory($httpClient);
        $this->tvSeasonFactory = new TvSeasonFactory($httpClient);
        $this->tvEpisodeFactory = new TvEpisodeFactory($httpClient);
        $this->networkFactory = new NetworkFactory($httpClient);
        $this->videoFactory = new VideoFactory($httpClient);
        $this->changesFactory = new ChangeFactory($httpClient);
        $this->keywordFactory = new KeywordFactory($httpClient);

        parent::__construct($httpClient);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = [])
    {
        $collection = new GenericCollection();

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    /**
     * @param array $data
     *
     * @return Tv|null
     */
    public function create(array $data = []): ?Tv
    {
        if (!$data) {
            return null;
        }

        $tvShow = new Tv();

        if (array_key_exists('content_ratings', $data) && array_key_exists('results', $data['content_ratings'])) {
            $tvShow->setContentRatings(
                $this->createGenericCollection($data['content_ratings']['results'], new Tv\ContentRating())
            );
        }

        if (array_key_exists('credits', $data)) {
            if (array_key_exists('cast', $data['credits']) && $data['credits']['cast'] !== null) {
                $tvShow->getCredits()->setCast(
                    $this->getCastFactory()->createCollection(
                        $data['credits']['cast'],
                        new CastMember()
                    )
                );
            }

            if (array_key_exists('crew', $data['credits']) && $data['credits']['crew'] !== null) {
                $tvShow->getCredits()->setCrew(
                    $this->getCrewFactory()->createCollection(
                        $data['credits']['crew'],
                        new CrewMember()
                    )
                );
            }
        }

        /** External ids */
        if (array_key_exists('external_ids', $data) && $data['external_ids'] !== null) {
            $tvShow->setExternalIds(
                $this->hydrate(new ExternalIds(), $data['external_ids'])
            );
        }

        /** Genres */
        if (array_key_exists('genres', $data) && $data['genres'] !== null) {
            $tvShow->setGenres($this->getGenreFactory()->createCollection($data['genres']));
        }

        /** Genres */
        if (array_key_exists('genre_ids', $data)) {
            $formattedData = [];

            foreach ($data['genre_ids'] as $genreId) {
                $formattedData[] = [
                    'id' => $genreId
                ];
            }

            $tvShow->setGenres($this->getGenreFactory()->createCollection($formattedData));
        }

        /** Images */
        if (array_key_exists('images', $data) && $data['images'] !== null) {
            $tvShow->setImages(
                $this->getImageFactory()->createCollectionFromTv($data['images'])
            );
        }

        if (array_key_exists('backdrop_path', $data)) {
            $tvShow->setBackdropImage(
                $this->getImageFactory()->createFromPath($data['backdrop_path'], 'backdrop_path')
            );
        }

        if (array_key_exists('poster_path', $data)) {
            $tvShow->setPosterImage(
                $this->getImageFactory()->createFromPath($data['poster_path'], 'poster_path')
            );
        }

        /** Translations */
        if (array_key_exists('translations', $data) && null !== $data['translations']) {
            if (array_key_exists('translations', $data['translations'])) {
                $translations = $data['translations']['translations'];
            } else {
                $translations = $data['translations'];
            }

            $tvShow->setTranslations(
                $this->createGenericCollection($translations, new Translation())
            );
        }

        /** Seasons */
        if (array_key_exists('seasons', $data) && $data['seasons'] !== null) {
            $tvShow->setSeasons($this->getTvSeasonFactory()->createCollection($data['seasons']));
        }

        /** Episodes **/
        if (array_key_exists('last_episode_to_air', $data) && $data['last_episode_to_air'] !== null) {
            $tvShow->setLastEpisodeToAir($this->getTvEpisodeFactory()->create($data['last_episode_to_air']));
        }
        if (array_key_exists('next_episode_to_air', $data) && $data['next_episode_to_air'] !== null) {
            $tvShow->setNextEpisodeToAir($this->getTvEpisodeFactory()->create($data['next_episode_to_air']));
        }

        /** Networks */
        if (array_key_exists('networks', $data) && $data['networks'] !== null) {
            $tvShow->setNetworks($this->getNetworkFactory()->createCollection($data['networks']));
        }

        if (array_key_exists('watch/providers', $data) && array_key_exists('results', $data['watch/providers'])) {
            $watchProviders = new GenericCollection();
            foreach ($data['watch/providers']['results'] as $iso31661 => $countryWatchData) {
                $countryWatchData['iso_3166_1'] = $iso31661;

                foreach (['flatrate', 'rent', 'buy'] as $providerType) {
                    $typeProviders = new GenericCollection();
                    foreach ($countryWatchData[$providerType] ?? [] as $providerData) {
                        if (isset($providerData['provider_id'])) {
                            $providerData['id'] = $providerData['provider_id'];
                        }
                        if (isset($providerData['provider_name'])) {
                            $providerData['name'] = $providerData['provider_name'];
                        }

                        $providerData['iso_3166_1'] = $iso31661;
                        $providerData['type'] = $providerType;
                        $typeProviders->add(null, $this->hydrate(new Watch\Provider(), $providerData));
                    }
                    $countryWatchData[$providerType] = $typeProviders;
                }

                $watchProviders->add($iso31661, $this->hydrate(new Watch\Providers(), $countryWatchData));
            }
            $tvShow->setWatchProviders($watchProviders);
        }

        if (array_key_exists('videos', $data) && $data['videos'] !== null) {
            $tvShow->setVideos($this->getVideoFactory()->createCollection($data['videos']));
        }

        if (array_key_exists('keywords', $data) && array_key_exists('results', $data['keywords'])) {
            $tvShow->setKeywords($this->getKeywordFactory()->createCollection($data['keywords']['results']));
        }

        if (array_key_exists('changes', $data) && $data['changes'] !== null) {
            $tvShow->setChanges($this->getChangesFactory()->createCollection($data['changes']));
        }

        if (array_key_exists('similar', $data) && $data['similar'] !== null) {
            $tvShow->setSimilar($this->createResultCollection($data['similar']));
        }

        if (array_key_exists('recommendations', $data) && $data['recommendations'] !== null) {
            $tvShow->setRecommendations($this->createResultCollection($data['recommendations']));
        }

        if (array_key_exists('languages', $data) && $data['languages'] !== null) {
            $collection = new GenericCollection();

            foreach ($data['languages'] as $iso6391) {
                $object = new SpokenLanguage();
                $object->setIso6391($iso6391);

                $collection->add(null, $object);
            }

            $tvShow->setLanguages($collection);
        }

        if (array_key_exists('origin_country', $data) && $data['origin_country'] !== null) {
            $collection = new GenericCollection();

            foreach ($data['origin_country'] as $iso31661) {
                $object = new Country();
                $object->setIso31661($iso31661);

                $collection->add(null, $object);
            }

            $tvShow->setOriginCountry($collection);
        }

        if (array_key_exists('production_companies', $data)) {
            $tvShow->setProductionCompanies(
                $this->createGenericCollection($data['production_companies'], new Company())
            );
        }

        if (array_key_exists('created_by', $data) && $data['created_by'] !== null) {
            $collection = new GenericCollection();
            $factory = new PeopleFactory($this->getHttpClient());

            foreach ($data['created_by'] as $castMember) {
                $object = $factory->create($castMember, new CastMember());

                $collection->add(null, $object);
            }

            $tvShow->setCreatedBy($collection);
        }

        if (array_key_exists('alternative_titles', $data) && array_key_exists('results', $data['alternative_titles'])) {
            $tvShow->setAlternativeTitles(
                $this->createGenericCollection($data['alternative_titles']['results'], new Tv\AlternativeTitle())
            );
        }

        if (array_key_exists('episode_groups', $data) && array_key_exists('results', $data['episode_groups'])) {
            $episodeGroupCollection = new GenericCollection();

            foreach ($data['episode_groups']['results'] as $episodeGroup) {
                if (!is_null($episodeGroup['network'])) {
                    $episodeGroup['network'] = $this->hydrate(new Network(), $episodeGroup['network']);
                }

                $episodeGroupCollection->add(null, $this->hydrate(new Tv\EpisodeGroups(), $episodeGroup));
            }
            $tvShow->setEpisodeGroups($episodeGroupCollection);
        }

        return $this->hydrate($tvShow, $data);
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
     * @return self
     */
    public function setCastFactory($castFactory)
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
     * @return self
     */
    public function setCrewFactory($crewFactory)
    {
        $this->crewFactory = $crewFactory;

        return $this;
    }

    /**
     * @return GenreFactory
     */
    public function getGenreFactory()
    {
        return $this->genreFactory;
    }

    /**
     * @param GenreFactory $genreFactory
     * @return self
     */
    public function setGenreFactory($genreFactory)
    {
        $this->genreFactory = $genreFactory;

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
     * @return self
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;

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
     * @return self
     */
    public function setTvSeasonFactory($tvSeasonFactory)
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
     * @return self
     */
    public function setTvEpisodeFactory($tvEpisodeFactory)
    {
        $this->tvEpisodeFactory = $tvEpisodeFactory;

        return $this;
    }

    /**
     * @return NetworkFactory
     */
    public function getNetworkFactory()
    {
        return $this->networkFactory;
    }

    /**
     * @param NetworkFactory $networkFactory
     * @return self
     */
    public function setNetworkFactory($networkFactory)
    {
        $this->networkFactory = $networkFactory;

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
     * @return self
     */
    public function setVideoFactory($videoFactory)
    {
        $this->videoFactory = $videoFactory;

        return $this;
    }

    /**
     * @return KeywordFactory
     */
    public function getKeywordFactory()
    {
        return $this->keywordFactory;
    }

    /**
     * @param KeywordFactory $keywordFactory
     * @return self
     */
    public function setKeywordFactory($keywordFactory)
    {
        $this->keywordFactory = $keywordFactory;

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
     * @return self
     */
    public function setChangesFactory($changesFactory)
    {
        $this->changesFactory = $changesFactory;

        return $this;
    }
}
