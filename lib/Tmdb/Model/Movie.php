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
namespace Tmdb\Model;

use Tmdb\Model\Common\Collection;

use Tmdb\Model\Collection\Credits;
use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\People;

use Tmdb\Model\Common\Country;
use Tmdb\Model\Common\SpokenLanguage;
use Tmdb\Model\Movie\AlternativeTitle;
use Tmdb\Model\Movie\Keyword;
use Tmdb\Model\Movie\Release;
use Tmdb\Model\Movie\Translation;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;

class Movie extends AbstractModel {
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
     * @var Collection
     */
    private $belongsToCollection = null;

    /**
     * @var int
     */
    private $budget;

    /**
     * Genres
     *
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
     * @var Collection
     */
    private $productionCompanies;

    /**
     * @var Collection
     */
    private $productionCountries;

    /**
     * @var \DateTime
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
     * @var Collection
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
     * @var Collection
     */
    protected $alternativeTitles;

    /**
     * @var Collection
     */
    protected $changes;

    /**
     * Credits
     *
     * @var Credits
     */
    protected $credits;

    /**
     * Images
     *
     * @var Images
     */
    protected $images;

    /**
     * @var Collection
     */
    protected $keywords;

    /**
     * @var Collection
     */
    protected $lists;

    /**
     * @var Collection
     */
    protected $releases;

    /**
     * @var Collection
     */
    protected $similarMovies;

    /**
     * @var Collection
     */
    protected $trailers;

    /**
     * @var Collection
     */
    protected $translations;

    /**
     * Properties that are available in the API
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $_properties = array(
        'adult',
        'backdrop_path',
        'belongs_to_collection',
        'budget',
        'homepage',
        'id',
        'imdb_id',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'revenue',
        'runtime',
        'status',
        'tagline',
        'title',
        'vote_average',
        'vote_count',
    );

    /**
     * Constructor
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->genres              = new Genres();
        $this->productionCompanies = new Collection();
        $this->productionCountries = new Collection();
        $this->spokenLanguages     = new Collection();
        $this->alternativeTitles   = new Collection();
        $this->changes             = new Collection();
        $this->credits             = new Credits();
        $this->images              = new Images();
        $this->keywords            = new Collection();
        $this->lists               = new Collection();
        $this->releases            = new Collection();
        $this->similarMovies       = new Collection();
        $this->trailers            = new Collection();
        $this->translations        = new Collection();
    }

    /**
     * @param boolean $adult
     * @return $this
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param mixed $backdropPath
     * @return $this
     */
    public function setBackdropPath($backdropPath)
    {
        $this->backdropPath = $backdropPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBackdropPath()
    {
        return $this->backdropPath;
    }

    /**
     * @param null $belongsToCollection
     * @return $this
     */
    public function setBelongsToCollection($belongsToCollection)
    {
        $this->belongsToCollection = $belongsToCollection;
        return $this;
    }

    /**
     * @return null
     */
    public function getBelongsToCollection()
    {
        return $this->belongsToCollection;
    }

    /**
     * @param Collection $changes
     * @return $this
     */
    public function setChanges(Collection $changes)
    {
        $this->changes = $changes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * @param Genres $genres
     * @return $this
     */
    public function setGenres(Genres $genres)
    {
        $this->genres = $genres;
        return $this;
    }

    /**
     * @return Genre[]
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $homepage
     * @return $this
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Images $images
     * @return $this
     */
    public function setImages(Images $images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Image
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $imdbId
     * @return $this
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * @param mixed $originalTitle
     * @return $this
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * @param mixed $overview
     * @return $this
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * @param mixed $popularity
     * @return $this
     */
    public function setPopularity($popularity)
    {
        $this->popularity = (float) $popularity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @param mixed $posterPath
     * @return $this
     */
    public function setPosterPath($posterPath)
    {
        $this->posterPath = $posterPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosterPath()
    {
        return $this->posterPath;
    }

    /**
     * @param Collection $productionCompanies
     * @return $this
     */
    public function setProductionCompanies(Collection $productionCompanies)
    {
        $this->productionCompanies = $productionCompanies;
        return $this;
    }

    /**
     * @return Company[]
     */
    public function getProductionCompanies()
    {
        return $this->productionCompanies;
    }

    /**
     * @param Collection $productionCountries
     * @return $this
     */
    public function setProductionCountries(Collection $productionCountries)
    {
        $this->productionCountries = $productionCountries;
        return $this;
    }

    /**
     * @return Country
     */
    public function getProductionCountries()
    {
        return $this->productionCountries;
    }

    /**
     * @param \DateTime $releaseDate
     * @return $this
     */
    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $revenue
     * @return $this
     */
    public function setRevenue($revenue)
    {
        $this->revenue = (int) $revenue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param mixed $runtime
     * @return $this
     */
    public function setRuntime($runtime)
    {
        $this->runtime = (int) $runtime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @param Collection $spokenLanguages
     * @return $this
     */
    public function setSpokenLanguages(Collection $spokenLanguages)
    {
        $this->spokenLanguages = $spokenLanguages;
        return $this;
    }

    /**
     * @return SpokenLanguage[]
     */
    public function getSpokenLanguages()
    {
        return $this->spokenLanguages;
    }

    /**
     * @param mixed $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $tagline
     * @return $this
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * @param mixed $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $voteAverage
     * @return $this
     */
    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = (float) $voteAverage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    /**
     * @param mixed $voteCount
     * @return $this
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = (int) $voteCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * @param People\Cast $cast
     * @return $this
     */
    public function setCast(People\Cast $cast)
    {
        $this->credits->setCast($cast);
        return $this;
    }

    /**
     * @return CastMember[]
     */
    public function getCast()
    {
        return $this->credits->getCast();
    }

    /**
     * @param People\Crew $crew
     * @return $this
     */
    public function setCrew(People\Crew $crew)
    {
        $this->credits->setCrew($crew);
        return $this;
    }

    /**
     * @return CrewMember[]
     */
    public function getCrew()
    {
        return $this->credits->getCrew();
    }

    /**
     * @param Collection $alternativeTitles
     * @return $this
     */
    public function setAlternativeTitles($alternativeTitles)
    {
        $this->alternativeTitles = $alternativeTitles;
        return $this;
    }

    /**
     * @return AlternativeTitle[]
     */
    public function getAlternativeTitles()
    {
        return $this->alternativeTitles;
    }

    /**
     * @param int $budget
     * @return $this
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
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
     * @param Credits $credits
     * @return $this
     */
    public function setCredits(Credits $credits)
    {
        $this->credits = $credits;
        return $this;
    }

    /**
     * @return Credits
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param Collection $keywords
     * @return $this
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return Keyword[]
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param Collection $lists
     * @return $this
     */
    public function setLists($lists)
    {
        $this->lists = $lists;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * @param Collection $releases
     * @return $this
     */
    public function setReleases(Collection $releases)
    {
        $this->releases = $releases;
        return $this;
    }

    /**
     * @return Release[]
     */
    public function getReleases()
    {
        return $this->releases;
    }

    /**
     * @param Collection $similarMovies
     * @return $this
     */
    public function setSimilarMovies($similarMovies)
    {
        $this->similarMovies = $similarMovies;
        return $this;
    }

    /**
     * @return Movie[]
     */
    public function getSimilarMovies()
    {
        return $this->similarMovies;
    }

    /**
     * @param Collection $trailers
     * @return $this
     */
    public function setTrailers($trailers)
    {
        $this->trailers = $trailers;
        return $this;
    }

    /**
     * @todo fix the phpdoc when we have actually implemented support for more providers in the future
     *
     * @return \Tmdb\Model\Common\Trailer\Youtube[]
     */
    public function getTrailers()
    {
        return $this->trailers;
    }

    /**
     * @param Collection $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return Translation[]
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param \Tmdb\Model\Image $backdrop
     * @return $this
     */
    public function setBackdrop($backdrop)
    {
        $this->backdrop = $backdrop;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Image
     */
    public function getBackdrop()
    {
        return $this->backdrop;
    }

    /**
     * @param \Tmdb\Model\Image $poster
     * @return $this
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Image
     */
    public function getPoster()
    {
        return $this->poster;
    }
}