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
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\Country;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\SpokenLanguage;
use Tmdb\Model\Movie\AlternativeTitle;
use Tmdb\Model\Movie\Release;
use Tmdb\Model\Movie\ReleaseDate;

/**
 * Class Movie.
 */
class Movie extends AbstractModel
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
        'belongs_to_collection',
        'budget',
        'homepage',
        'id',
        'imdb_id',
        'original_title',
        'original_language',
        'overview',
        'popularity',
        'poster_path',
        'release_date',
        'revenue',
        'runtime',
        'status',
        'tagline',
        'title',
        'vote_average',
        'vote_count',
    ];
    protected \Tmdb\Model\Common\GenericCollection $alternativeTitles;
    /**
     * @var GenericCollection
     */
    protected $changes;
    /**
     * Credits.
     */
    protected \Tmdb\Model\Collection\CreditsCollection $credits;
    /**
     * External Ids.
     */
    private \Tmdb\Model\Common\ExternalIds $externalIds;
    /**
     * Images.
     */
    protected \Tmdb\Model\Collection\Images $images;
    protected \Tmdb\Model\Common\GenericCollection $keywords;
    protected \Tmdb\Model\Common\GenericCollection $lists;
    /**
     * @var GenericCollection
     *
     * @deprecated Use $release_dates instead
     */
    protected $releases;
    /**
     * @var GenericCollection
     */
    protected $release_dates;
    protected \Tmdb\Model\Common\GenericCollection $similar;
    protected \Tmdb\Model\Common\GenericCollection $recommendations;
    protected \Tmdb\Model\Common\GenericCollection $translations;
    /**
     * @var ResultCollection
     */
    protected $reviews;
    /**
     * @var Videos|ResultCollection|mixed
     */
    protected $videos;
    private bool $adult = false;
    /**
     * @var string
     */
    private $backdropPath;
    /**
     * @var StillImage
     */
    protected $backdrop;
    /**
     * @var PosterImage
     */
    protected $poster;
    /**
     * @var int
     */
    private $budget;
    private \Tmdb\Model\Collection\Genres $genres;
    /**
     * @var string
     */
    private $homepage;
    private ?int $id = null;
    /**
     * @var string
     */
    private $imdbId;
    /**
     * @var string
     */
    private $originalTitle;
    /**
     * @var string
     */
    private $originalLanguage;
    /**
     * @var string
     */
    private $overview;
    private ?float $popularity = null;
    /**
     * @var string
     */
    private $posterPath;
    private \Tmdb\Model\Common\GenericCollection $productionCompanies;
    private \Tmdb\Model\Common\GenericCollection $productionCountries;
    /**
     * @var ?DateTime
     */
    private null|\DateTime|string $releaseDate = null;
    private ?int $revenue = null;
    private ?int $runtime = null;
    private \Tmdb\Model\Common\GenericCollection $spokenLanguages;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $tagline;
    /**
     * @var string
     */
    private $title;
    private ?float $voteAverage = null;
    private ?int $voteCount = null;
    private \Tmdb\Model\Common\GenericCollection $watchProviders;
    /**
     * @var GenericCollection
     */
    private $belongsToCollection;

    /**
     * Constructor.
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->genres = new Genres();
        $this->productionCompanies = new GenericCollection();
        $this->productionCountries = new GenericCollection();
        $this->spokenLanguages = new GenericCollection();
        $this->alternativeTitles = new GenericCollection();
        $this->changes = new GenericCollection();
        $this->credits = new CreditsCollection();
        $this->externalIds = new ExternalIds();
        $this->images = new Images();
        $this->keywords = new GenericCollection();
        $this->lists = new GenericCollection();
        $this->releases = new GenericCollection();
        $this->release_dates = new GenericCollection();
        $this->similar = new GenericCollection();
        $this->recommendations = new GenericCollection();
        $this->translations = new GenericCollection();
        $this->videos = new Videos();
        $this->watchProviders = new GenericCollection();
    }

    /**
     * @return bool
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param bool $adult
     */
    public function setAdult($adult): static
    {
        $this->adult = (bool) $adult;

        return $this;
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
    public function getBelongsToCollection()
    {
        return $this->belongsToCollection;
    }

    /**
     * @param GenericCollection $belongsToCollection
     */
    public function setBelongsToCollection($belongsToCollection): static
    {
        $this->belongsToCollection = $belongsToCollection;

        return $this;
    }

    public function getChanges(): GenericCollection
    {
        return $this->changes;
    }

    public function setChanges(GenericCollection $changes): static
    {
        $this->changes = $changes;

        return $this;
    }

    /**
     * @return Genres
     */
    public function getGenres()
    {
        return $this->genres;
    }

    public function setGenres(Genres $genres): static
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

    public function setId($id): static
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return Images Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    public function setImages(Images $images): static
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return string
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * @param string $imdbId
     */
    public function setImdbId($imdbId): static
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * @param string $originalTitle
     */
    public function setOriginalTitle($originalTitle): static
    {
        $this->originalTitle = $originalTitle;

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
     * @return GenericCollection|Company[]
     */
    public function getProductionCompanies()
    {
        return $this->productionCompanies;
    }

    public function setProductionCompanies(GenericCollection $productionCompanies): static
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    /**
     * @return GenericCollection|Country[]
     */
    public function getProductionCountries()
    {
        return $this->productionCountries;
    }

    public function setProductionCountries(GenericCollection $productionCountries): static
    {
        $this->productionCountries = $productionCountries;

        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param DateTime|string|null $releaseDate
     */
    public function setReleaseDate($releaseDate = null): static
    {
        if (empty($releaseDate)) {
            $this->releaseDate = null;
        } elseif (!$releaseDate instanceof DateTime) {
            $releaseDate = new DateTime($releaseDate);
        }

        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    public function setRevenue($revenue): static
    {
        $this->revenue = (int) $revenue;

        return $this;
    }

    /**
     * @return int
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    public function setRuntime($runtime): static
    {
        $this->runtime = (int) $runtime;

        return $this;
    }

    /**
     * @return GenericCollection|SpokenLanguage[]
     */
    public function getSpokenLanguages()
    {
        return $this->spokenLanguages;
    }

    public function setSpokenLanguages(GenericCollection $spokenLanguages): static
    {
        $this->spokenLanguages = $spokenLanguages;

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
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * @param string $tagline
     */
    public function setTagline($tagline): static
    {
        $this->tagline = $tagline;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return float
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

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

    public function setVoteCount($voteCount): static
    {
        $this->voteCount = (int) $voteCount;

        return $this;
    }

    /**
     * @return GenericCollection|AlternativeTitle[]
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

    /**
     * @return int
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param int $budget
     */
    public function setBudget($budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return CreditsCollection
     */
    public function getCredits()
    {
        return $this->credits;
    }

    public function setCredits(CreditsCollection $credits): static
    {
        $this->credits = $credits;

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
     * @return GenericCollection|Keyword[]
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
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * @param GenericCollection $lists
     */
    public function setLists($lists): static
    {
        $this->lists = $lists;

        return $this;
    }

    /**
     * @return GenericCollection|Release[]
     *
     * @deprecated Use the getReleaseDates instead
     */
    public function getReleases()
    {
        return $this->releases;
    }

    /**
     * @deprecated use the setReleaseDates instead
     */
    public function setReleases(GenericCollection $releases): static
    {
        $this->releases = $releases;

        return $this;
    }

    /**
     * @return GenericCollection|ReleaseDate[]
     */
    public function getReleaseDates()
    {
        return $this->release_dates;
    }

    public function setReleaseDates(GenericCollection $release_dates): static
    {
        $this->release_dates = $release_dates;

        return $this;
    }

    /**
     * @return GenericCollection|Movie[]
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
     * @return GenericCollection|Movie[]
     *
     * @deprecated Use getSimilar instead
     */
    public function getSimilarMovies()
    {
        return $this->getSimilar();
    }

    /**
     * @return GenericCollection|Movie[]
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

    public function getTranslations(): GenericCollection
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
     * @param Image $backdrop
     */
    public function setBackdropImage($backdrop): static
    {
        $this->backdrop = $backdrop;

        return $this;
    }

    /**
     * @return Image
     */
    public function getBackdropImage()
    {
        return $this->backdrop;
    }

    /**
     * @param Image $poster
     */
    public function setPosterImage($poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return Image
     */
    public function getPosterImage()
    {
        return $this->poster;
    }

    /**
     * @return ResultCollection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param ResultCollection $reviews
     */
    public function setReviews($reviews): static
    {
        $this->reviews = $reviews;

        return $this;
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
}
