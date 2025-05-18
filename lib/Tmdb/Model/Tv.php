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

use DateTime;
use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\SpokenLanguage;
use Tmdb\Model\Image\BackdropImage;
use Tmdb\Model\Image\PosterImage;
use Tmdb\Model\Tv\Episode;

/**
 * Class Tv.
 */
class Tv extends AbstractModel
{
    /**
     * Properties that are available in the API.
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'adult',
        'backdrop_path',
        'episode_run_time',
        'first_air_date',
        'homepage',
        'id',
        'in_production',
        'last_air_date',
        'name',
        'number_of_episodes',
        'number_of_seasons',
        'original_name',
        'original_language',
        'overview',
        'popularity',
        'poster_path',
        'status',
        'vote_average',
        'vote_count',
        'type',
    ];
    /**
     * Credits.
     * @var CreditsCollection|mixed
     */
    protected $credits;
    /**
     * External Ids.
     */
    protected \Tmdb\Model\Common\ExternalIds $externalIds;
    /**
     * Images.
     */
    protected \Tmdb\Model\Collection\Images $images;
    protected \Tmdb\Model\Common\GenericCollection $translations;
    /**
     * @var BackdropImage
     */
    protected $backdrop;
    /**
     * @var PosterImage
     */
    protected $poster;
    protected \Tmdb\Model\Collection\Videos $videos;
    protected \Tmdb\Model\Common\GenericCollection $changes;
    protected \Tmdb\Model\Common\GenericCollection $keywords;
    protected \Tmdb\Model\Common\GenericCollection $similar;
    protected \Tmdb\Model\Common\GenericCollection $recommendations;
    /**
     * @var GenericCollection
     */
    protected $productionCompanies;
    /**
     * Alternative titles.
     */
    protected \Tmdb\Model\Common\GenericCollection $alternativeTitles;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    private $backdropPath;
    /**
     * @var GenericCollection
     */
    private $createdBy;
    private \Tmdb\Model\Common\GenericCollection $contentRatings;
    /**
     * @var array
     */
    private $episodeRunTime;
    private ?\DateTime $firstAirDate = null;
    /**
     * Genres.
     */
    private \Tmdb\Model\Collection\Genres $genres;
    /**
     * @var string
     */
    private $homepage;
    private ?int $id = null;
    /**
     * @var bool
     */
    private $inProduction;
    /**
     * @var GenericCollection|SpokenLanguage[]
     */
    private \Tmdb\Model\Common\GenericCollection $languages;
    private ?\DateTime $lastAirDate = null;
    /**
     * @var string
     */
    private $name;
    /**
     * @var GenericCollection|Network[]
     */
    private \Tmdb\Model\Common\GenericCollection $networks;
    private ?int $numberOfEpisodes = null;
    private ?int $numberOfSeasons = null;
    /**
     * @var Episode
     */
    private $lastEpisodeToAir;
    /**
     * @var Episode
     */
    private $nextEpisodeToAir;
    /**
     * @var string
     */
    private $originalName;
    /**
     * @var string
     */
    private $originalLanguage;
    private \Tmdb\Model\Common\GenericCollection $originCountry;
    /**
     * @var string
     */
    private $overview;
    private ?float $popularity = null;
    /**
     * @var string
     */
    private $posterPath;
    private \Tmdb\Model\Common\GenericCollection $seasons;
    /**
     * @var string
     */
    private $status;
    private ?float $voteAverage = null;
    private ?int $voteCount = null;
    private \Tmdb\Model\Common\GenericCollection $watchProviders;
    /**
     * @var GenericCollection
     */
    protected $episodeGroups;
    private bool $adult = false;

    /**
     * Constructor.
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->genres = new Genres();
        $this->networks = new GenericCollection();
        $this->originCountry = new GenericCollection();
        $this->seasons = new GenericCollection();
        $this->credits = new CreditsCollection();
        $this->externalIds = new ExternalIds();
        $this->images = new Images();
        $this->translations = new GenericCollection();
        $this->videos = new Videos();
        $this->changes = new GenericCollection();
        $this->keywords = new GenericCollection();
        $this->similar = new GenericCollection();
        $this->recommendations = new GenericCollection();
        $this->contentRatings = new GenericCollection();
        $this->alternativeTitles = new GenericCollection();
        $this->languages = new GenericCollection();
        $this->watchProviders = new GenericCollection();
        $this->episodeGroups = new GenericCollection();
    }

    /**
     * @return string
     */
    public function getBackdropPath()
    {
        return $this->backdropPath;
    }

    /**
     * @param string $backdropPath
     */
    public function setBackdropPath($backdropPath): static
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getContentRatings()
    {
        return $this->contentRatings;
    }

    /**
     * @param GenericCollection $contentRatings
     */
    public function setContentRatings($contentRatings): static
    {
        $this->contentRatings = $contentRatings;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param GenericCollection $createdBy
     */
    public function setCreatedBy($createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return array
     */
    public function getEpisodeRunTime()
    {
        return $this->episodeRunTime;
    }

    /**
     * @param array $episodeRunTime
     */
    public function setEpisodeRunTime($episodeRunTime): static
    {
        $this->episodeRunTime = $episodeRunTime;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getFirstAirDate()
    {
        return $this->firstAirDate;
    }

    /**
     * @param DateTime|string|null $firstAirDate
     */
    public function setFirstAirDate($firstAirDate = null): static
    {
        if (!$firstAirDate instanceof DateTime && null !== $firstAirDate) {
            $firstAirDate = new DateTime($firstAirDate);
        }

        $this->firstAirDate = $firstAirDate;

        return $this;
    }

    /**
     * @return Genres
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param Genres $genres
     */
    public function setGenres($genres): static
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     */
    public function setHomepage($homepage): static
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): static
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return bool
     */
    public function getInProduction()
    {
        return $this->inProduction;
    }

    /**
     * @param bool $inProduction
     */
    public function setInProduction($inProduction): static
    {
        $this->inProduction = $inProduction;

        return $this;
    }

    public function getLanguages(): GenericCollection
    {
        return $this->languages;
    }

    /**
     * @param GenericCollection $languages
     */
    public function setLanguages($languages): static
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLastAirDate()
    {
        return $this->lastAirDate;
    }

    /**
     * @param DateTime|string|null $lastAirDate
     */
    public function setLastAirDate($lastAirDate = null): static
    {
        if (!$lastAirDate instanceof DateTime && null !== $lastAirDate) {
            $lastAirDate = new DateTime($lastAirDate);
        }

        $this->lastAirDate = $lastAirDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return GenericCollection|Network[]
     *
     * @psalm-return GenericCollection|array<array-key, Network>
     */
    public function getNetworks()
    {
        return $this->networks;
    }

    /**
     * @param GenericCollection $networks
     */
    public function setNetworks($networks): static
    {
        $this->networks = $networks;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfEpisodes()
    {
        return $this->numberOfEpisodes;
    }

    /**
     * @param int $numberOfEpisodes
     */
    public function setNumberOfEpisodes($numberOfEpisodes): static
    {
        $this->numberOfEpisodes = (int) $numberOfEpisodes;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfSeasons()
    {
        return $this->numberOfSeasons;
    }

    /**
     * @param int $numberOfSeasons
     */
    public function setNumberOfSeasons($numberOfSeasons): static
    {
        $this->numberOfSeasons = (int) $numberOfSeasons;

        return $this;
    }

    public function getLastEpisodeToAir(): ?Episode
    {
        return $this->lastEpisodeToAir;
    }

    /**
     * @param ?Episode $lastEpisodeToAir
     */
    public function setLastEpisodeToAir($lastEpisodeToAir): static
    {
        $this->lastEpisodeToAir = $lastEpisodeToAir;

        return $this;
    }

    public function getNextEpisodeToAir(): ?Episode
    {
        return $this->nextEpisodeToAir;
    }

    /**
     * @param ?Episode $nextEpisodeToAir
     */
    public function setNextEpisodeToAir($nextEpisodeToAir): static
    {
        $this->nextEpisodeToAir = $nextEpisodeToAir;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * @param GenericCollection $originCountry
     */
    public function setOriginCountry($originCountry): static
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     */
    public function setOriginalName($originalName): static
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage()
    {
        return $this->originalLanguage;
    }

    /**
     * @param string $originalLanguage
     */
    public function setOriginalLanguage($originalLanguage): static
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    /**
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     */
    public function setOverview($overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * @return float
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @param float $popularity
     */
    public function setPopularity($popularity): static
    {
        $this->popularity = (float) $popularity;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosterPath()
    {
        return $this->posterPath;
    }

    /**
     * @param string $posterPath
     */
    public function setPosterPath($posterPath): static
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * @param GenericCollection $seasons
     */
    public function setSeasons($seasons): static
    {
        $this->seasons = $seasons;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return float
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    /**
     * @param float $voteAverage
     */
    public function setVoteAverage($voteAverage): static
    {
        $this->voteAverage = (float) $voteAverage;

        return $this;
    }

    /**
     * @return int
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * @param int $voteCount
     */
    public function setVoteCount($voteCount): static
    {
        $this->voteCount = (int) $voteCount;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param GenericCollection $translations
     */
    public function setTranslations($translations): static
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @return Images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Images $images
     */
    public function setImages($images): static
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return ExternalIds
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    /**
     * @param ExternalIds $externalIds
     */
    public function setExternalIds($externalIds): static
    {
        $this->externalIds = $externalIds;

        return $this;
    }

    /**
     * @return CreditsCollection
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param CreditsCollection $credits
     */
    public function setCredits($credits): static
    {
        $this->credits = $credits;

        return $this;
    }

    public function setBackdropImage(BackdropImage $backdrop): static
    {
        $this->backdrop = $backdrop;

        return $this;
    }

    /**
     * @return BackdropImage
     */
    public function getBackdropImage()
    {
        return $this->backdrop;
    }

    public function setPosterImage(PosterImage $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return PosterImage
     */
    public function getPosterImage()
    {
        return $this->poster;
    }

    /**
     * @return Videos
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Videos $videos
     */
    public function setVideos($videos): static
    {
        $this->videos = $videos;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * @param GenericCollection $changes
     */
    public function setChanges($changes): static
    {
        $this->changes = $changes;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param GenericCollection $keywords
     */
    public function setKeywords($keywords): static
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getSimilar()
    {
        return $this->similar;
    }

    /**
     * @param GenericCollection $similar
     */
    public function setSimilar($similar): static
    {
        $this->similar = $similar;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getRecommendations()
    {
        return $this->recommendations;
    }

    /**
     * @param GenericCollection $recommendations
     */
    public function setRecommendations($recommendations): static
    {
        $this->recommendations = $recommendations;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getProductionCompanies()
    {
        return $this->productionCompanies;
    }

    /**
     * @param GenericCollection $productionCompanies
     */
    public function setProductionCompanies($productionCompanies): static
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getAlternativeTitles()
    {
        return $this->alternativeTitles;
    }

    /**
     * @param GenericCollection $alternativeTitles
     */
    public function setAlternativeTitles($alternativeTitles): static
    {
        $this->alternativeTitles = $alternativeTitles;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType($type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getWatchProviders(): GenericCollection
    {
        return $this->watchProviders;
    }

    /**
     * @param GenericCollection $watchProviders
     */
    public function setWatchProviders($watchProviders): static
    {
        $this->watchProviders = $watchProviders;

        return $this;
    }

    public function getEpisodeGroups(): GenericCollection
    {
        return $this->episodeGroups;
    }

    public function setEpisodeGroups(GenericCollection $episodeGroups): Tv
    {
        $this->episodeGroups = $episodeGroups;

        return $this;
    }

    public function getAdult(): bool
    {
        return $this->adult;
    }

    public function setAdult(bool $adult): void
    {
        $this->adult = $adult;
    }
}
