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
 * Class Movie
 * @package Tmdb\Model
 */
class Movie extends AbstractModel
{
    /**
     * Properties that are available in the API
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
    /**
     * @var GenericCollection
     */
    protected $alternativeTitles;
    /**
     * @var GenericCollection
     */
    protected $changes;
    /**
     * Credits
     *
     * @var CreditsCollection
     */
    protected $credits;
    /**
     * External Ids
     *
     * @var ExternalIds
     */
    private $externalIds;
    /**
     * Images
     *
     * @var Images
     */
    protected $images;
    /**
     * @var GenericCollection
     */
    protected $keywords;
    /**
     * @var GenericCollection
     */
    protected $lists;
    /**
     * @var GenericCollection
     * @deprecated Use $release_dates instead
     */
    protected $releases;
    /**
     * @var GenericCollection
     */
    protected $release_dates;
    /**
     * @var GenericCollection
     */
    protected $similar;
    /**
     * @var GenericCollection
     */
    protected $recommendations;
    /**
     * @var GenericCollection
     */
    protected $translations;
    /**
     * @var ResultCollection
     */
    protected $reviews;
    /**
     * @var Videos
     */
    protected $videos;
    /**
     * @var bool
     */
    private $adult = false;
    /**
     * @var string
     */
    private $backdropPath;
    /**
     * @var Image
     */
    private $backdrop;
    /**
     * @var GenericCollection
     */
    private $belongsToCollection;
    /**
     * @var int
     */
    private $budget;
    /**
     * @var Genres
     */
    private $genres;
    /**
     * @var string
     */
    private $homepage;
    /**
     * @var int
     */
    private $id;
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
    /**
     * @var float
     */
    private $popularity;
    /**
     * @var Image
     */
    private $poster;
    /**
     * @var string
     */
    private $posterPath;
    /**
     * @var GenericCollection
     */
    private $productionCompanies;
    /**
     * @var GenericCollection
     */
    private $productionCountries;
    /**
     * @var DateTime
     */
    private $releaseDate;
    /**
     * @var int
     */
    private $revenue;
    /**
     * @var int
     */
    private $runtime;
    /**
     * @var GenericCollection
     */
    private $spokenLanguages;
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
    /**
     * @var float
     */
    private $voteAverage;
    /**
     * @var int
     */
    private $voteCount;
    /**
     * @var GenericCollection
     */
    private $watchProviders;

    /**
     * Constructor
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
     * @return boolean
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param boolean $adult
     * @return self
     */
    public function setAdult($adult)
    {
        $this->adult = (bool)$adult;

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
     * @return self
     */
    public function setBackdropPath($backdropPath)
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
     * @param null $belongsToCollection
     * @return self
     */
    public function setBelongsToCollection($belongsToCollection)
    {
        $this->belongsToCollection = $belongsToCollection;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getChanges(): GenericCollection
    {
        return $this->changes;
    }

    /**
     * @param GenericCollection $changes
     * @return self
     */
    public function setChanges(GenericCollection $changes)
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

    /**
     * @param Genres $genres
     * @return self
     */
    public function setGenres(Genres $genres)
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
     * @return self
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

    /**
     * @return Images Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Images $images
     * @return self
     */
    public function setImages(Images $images)
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
     * @return self
     */
    public function setImdbId($imdbId)
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
     * @return self
     */
    public function setOriginalTitle($originalTitle)
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
     * @return self
     */
    public function setOriginalLanguage($originalLanguage)
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
     * @return self
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * @return double
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @param mixed $popularity
     * @return self
     */
    public function setPopularity($popularity)
    {
        $this->popularity = (float)$popularity;

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
     * @return self
     */
    public function setPosterPath($posterPath)
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

    /**
     * @param GenericCollection $productionCompanies
     * @return self
     */
    public function setProductionCompanies(GenericCollection $productionCompanies)
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

    /**
     * @param GenericCollection $productionCountries
     * @return self
     */
    public function setProductionCountries(GenericCollection $productionCountries)
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
     * @return self
     */
    public function setReleaseDate($releaseDate = null)
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
     * @return integer
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param mixed $revenue
     * @return self
     */
    public function setRevenue($revenue)
    {
        $this->revenue = (int)$revenue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @param mixed $runtime
     * @return self
     */
    public function setRuntime($runtime)
    {
        $this->runtime = (int)$runtime;

        return $this;
    }

    /**
     * @return GenericCollection|SpokenLanguage[]
     */
    public function getSpokenLanguages()
    {
        return $this->spokenLanguages;
    }

    /**
     * @param GenericCollection $spokenLanguages
     * @return self
     */
    public function setSpokenLanguages(GenericCollection $spokenLanguages)
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
     * @return self
     */
    public function setStatus($status)
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
     * @return self
     */
    public function setTagline($tagline)
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
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return double
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    /**
     * @param mixed $voteAverage
     * @return self
     */
    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = (float)$voteAverage;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * @param mixed $voteCount
     * @return self
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = (int)$voteCount;

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
     * @return self
     */
    public function setAlternativeTitles($alternativeTitles)
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
     * @return self
     */
    public function setBudget($budget)
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

    /**
     * @param CreditsCollection $credits
     * @return self
     */
    public function setCredits(CreditsCollection $credits)
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
     * @return self
     */
    public function setExternalIds($externalIds)
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
     * @return self
     */
    public function setKeywords($keywords)
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
     * @return self
     */
    public function setLists($lists)
    {
        $this->lists = $lists;

        return $this;
    }

    /**
     * @return GenericCollection|Release[]
     * @deprecated Use the getReleaseDates instead
     */
    public function getReleases()
    {
        return $this->releases;
    }

    /**
     * @param GenericCollection $releases
     * @return self
     * @deprecated Use the setReleaseDates instead.
     */
    public function setReleases(GenericCollection $releases)
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

    /**
     * @param GenericCollection $release_dates
     * @return self
     */
    public function setReleaseDates(GenericCollection $release_dates)
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
     * @return self
     */
    public function setRecommendations($recommendations)
    {
        $this->recommendations = $recommendations;

        return $this;
    }

    /**
     * @return GenericCollection|Movie[]
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
     * @return self
     */
    public function setSimilar($similar)
    {
        $this->similar = $similar;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTranslations(): GenericCollection
    {
        return $this->translations;
    }

    /**
     * @param GenericCollection $translations
     * @return self
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @param Image $backdrop
     * @return self
     */
    public function setBackdropImage($backdrop)
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
     * @return self
     */
    public function setPosterImage($poster)
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
     * @return self
     */
    public function setReviews($reviews)
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
     * @return self
     */
    public function setVideos($videos)
    {
        $this->videos = $videos;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getWatchProviders(): GenericCollection
    {
        return $this->watchProviders;
    }

    /**
     * @param GenericCollection $watchProviders
     * @return self
     */
    public function setWatchProviders($watchProviders)
    {
        $this->watchProviders = $watchProviders;

        return $this;
    }
}
