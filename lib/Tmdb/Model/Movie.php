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

use Tmdb\Client;
use Tmdb\Model\Common\Genres;
use Tmdb\Model\Common\Images;
use Tmdb\Model\Common\People;

class Movie extends AbstractModel {

    private $adult = false;
    private $backdropPath;
    private $belongsToCollection = null;
    private $homepage;
    private $id;
    private $imdbId;
    private $originalTitle;
    private $overview;
    private $popularity;
    private $posterPath;
    private $productionCompanies;
    private $productionCountries;
    private $releaseDate;
    private $revenue;
    private $runtime;
    private $spokenLanguages;
    private $status;
    private $tagline;
    private $title;
    private $voteAverage;
    private $voteCount;

    /**
     * Cast members
     *
     * @var Movie\Cast
     */
    protected $cast;

    /**
     * Crew members
     *
     * @var
     */
    protected $crew;

    /**
     * Genres
     *
     * @var Common\Genres
     */
    protected $genres;
    protected $images;
    protected $changes;

    protected static $_properties = array(
        'adult',
        'backdropPath',
        'belongsToCollection',
        'homepage',
        'id',
        'imdbId',
        'originalTitle',
        'overview',
        'popularity',
        'posterPath',
        'productionCompanies',
        'productionCountries',
        'releaseDate',
        'revenue',
        'runtime',
        'spokenLanguages',
        'status',
        'tagline',
        'title',
        'voteAverage',
        'voteCount',
    );

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genres = new Common\Genres();
        $this->images = new Common\Images();
        $this->cast   = new Movie\Cast();
        $this->crew   = new People();
    }

    /**
     * Convert an array to an hydrated object
     *
     * @param Client $client
     * @param array $data
     * @return $this
     */
    public static function fromArray(Client $client, array $data)
    {
        $movie = new Movie($data['id']);
        //$movie->setClient($client);

        if (array_key_exists('casts', $data)) {
            $movie->setCast(parent::collectPeople($client, $data['casts']['cast']));
        }

        if (array_key_exists('crew', $data)) {
            $movie->setCrew(parent::collectPeople($client, $data['casts']['crew']));
        }

        if (array_key_exists('genres', $data)) {
            $movie->setGenres(parent::collectGenres($client, $data['genres']));
        }

        if (array_key_exists('images', $data)) {
            $movie->setImages(parent::collectImages($client, $data['images']));
        }

        return $movie->hydrate($data);
    }

    /**
     * Load a movie with the given identifier
     *
     * @param Client $client
     * @param $id
     * @param $with
     * @return $this
     */
    public static function load(Client $client, $id, array $with = array()) {
        $data = $client->api('movies')->getMovie($id, $with);

        return Movie::fromArray($client, $data);
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
     * @param mixed $changes
     * @return $this
     */
    public function setChanges($changes)
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
     * @param \Tmdb\Model\Common\Genres $genres
     * @return $this
     */
    public function setGenres(Genres $genres)
    {
        $this->genres = $genres;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Genre[]
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
        $this->id = $id;
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
     * @param \Tmdb\Model\Common\Images $images
     * @return $this
     */
    public function setImages(Images $images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Image[]
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
        $this->popularity = $popularity;
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
     * @param mixed $productionCompanies
     * @return $this
     */
    public function setProductionCompanies($productionCompanies)
    {
        $this->productionCompanies = $productionCompanies;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductionCompanies()
    {
        return $this->productionCompanies;
    }

    /**
     * @param mixed $productionCountries
     * @return $this
     */
    public function setProductionCountries($productionCountries)
    {
        $this->productionCountries = $productionCountries;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductionCountries()
    {
        return $this->productionCountries;
    }

    /**
     * @param mixed $releaseDate
     * @return $this
     */
    public function setReleaseDate($releaseDate)
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
        $this->revenue = $revenue;
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
        $this->runtime = $runtime;
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
     * @param mixed $spokenLanguages
     * @return $this
     */
    public function setSpokenLanguages($spokenLanguages)
    {
        $this->spokenLanguages = $spokenLanguages;
        return $this;
    }

    /**
     * @return mixed
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
        $this->voteAverage = $voteAverage;
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
        $this->voteCount = $voteCount;
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
     * @param \Tmdb\Model\Common\People $cast
     * @return $this
     */
    public function setCast(People $cast)
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Common\People
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @param mixed $crew
     * @return $this
     */
    public function setCrew($crew)
    {
        $this->crew = $crew;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrew()
    {
        return $this->crew;
    }

}