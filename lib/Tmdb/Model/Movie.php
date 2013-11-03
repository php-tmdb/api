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

use Tmdb\Model\Common\Collection;
use Tmdb\Model\Common\Collection\Images;

use Tmdb\Model\Collection\Credits;
use Tmdb\Model\Collection\Credits\Cast;
use Tmdb\Model\Collection\Credits\Crew;

use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Collection\People;

use Tmdb\Model\Common\Country;
use Tmdb\Model\Common\SpokenLanguage;

class Movie extends AbstractModel {

    private $adult = false;
    private $backdropPath;
    private $belongsToCollection = null;
    private $budget;

    /**
     * Genres
     *
     * @var Common\Genres
     */
    private $genres;
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

    protected $alternativeTitles;
    protected $changes;

    /**
     * Credits
     *
     * @var Common\Collection\Credits
     */
    protected $credits;

    /**
     * Images
     *
     * @var Common\Collection\Images
     */
    protected $images;
    protected $keywords;
    protected $lists;
    protected $releases;
    protected $similarMovies;
    protected $trailers;
    protected $translations;


    protected static $_properties = array(
        'adult',
        'backdrop_path',
        'belongs_to_collection',
        'budget',
        'genres',
        'homepage',
        'id',
        'imdb_id',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'production_companies',
        'production_countries',
        'release_date',
        'revenue',
        'runtime',
        'spoken_languages',
        'status',
        'tagline',
        'title',
        'vote_average',
        'vote_count',
        'alternative_titles',
        'changes',
        'credits',
        'images',
        'keywords',
        'lists',
        'releases',
        'similar_movies',
        'trailers',
        'translations',
    );

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genres  = new Common\Collection\Genres();
        $this->images  = new Common\Collection\Images();
        $this->credits = new Common\Collection\Credits();

        $this->credits->setCast(new Cast());
        $this->credits->setCrew(new Crew());
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

        $casts = array();

        if (array_key_exists('alternative_titles', $data)) {
            $movie->setAlternativeTitles(parent::collectAlternativeTitles($client, $data['alternative_titles']));
        }

        if (array_key_exists('casts', $data)) {
            $casts = $data['casts'];
        }

        if (array_key_exists('cast', $casts)) {
            $movie->setCast(parent::collectCast($client, $casts['cast']));
        }

        if (array_key_exists('crew', $casts)) {
            $movie->setCrew(parent::collectCrew($client, $casts['crew']));
        }

        if (array_key_exists('genres', $data)) {
            $movie->setGenres(parent::collectGenres($client, $data['genres']));
        }

        if (array_key_exists('images', $data)) {
            $movie->setImages(parent::collectImages($client, $data['images']));
        }

        if (array_key_exists('keywords', $data)) {
        }

        if (array_key_exists('releases', $data)) {
        }

        if (array_key_exists('trailers', $data)) {
        }

        if (array_key_exists('translations', $data)) {
        }

        if (array_key_exists('similar_movies', $data)) {
        }

        if (array_key_exists('reviews', $data)) {
        }

        if (array_key_exists('lists', $data)) {
        }

        if (array_key_exists('changes', $data)) {
        }

        return $movie->hydrate($data);
    }

    /**
     * Load a movie with the given identifier
     *
     * @param Client $client
     * @param $id
     * @param $parameters
     * @return $this
     */
    public static function load(Client $client, $id, array $parameters = array()) {
        $data = $client->api('movies')->getMovie($id, parent::parseQueryParameters($parameters));

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
     * @param People $cast
     * @return $this
     */
    public function setCast(People $cast)
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * @return Person[]
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @param People $crew
     * @return $this
     */
    public function setCrew($crew)
    {
        $this->crew = $crew;
        return $this;
    }

    /**
     * @return Person[]
     */
    public function getCrew()
    {
        return $this->crew;
    }

}