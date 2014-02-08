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
namespace Tmdb\Factory;

use Tmdb\Factory\People\CastFactory;
use Tmdb\Factory\People\CrewFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Trailer\Youtube;
use Tmdb\Model\Common\Translation;
use Tmdb\Model\Movie;

class MovieFactory extends AbstractFactory {
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
     * Constructor
     */
    public function __construct()
    {
        $this->castFactory  = new CastFactory();
        $this->crewFactory  = new CrewFactory();
        $this->genreFactory = new GenreFactory();
        $this->imageFactory = new ImageFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data = array())
    {
        if (!$data) {
            return null;
        }

        $movie = new Movie();

        if (array_key_exists('alternative_titles', $data) && array_key_exists('titles', $data['alternative_titles'])) {
            $movie->setAlternativeTitles(
                $this->createGenericCollection($data['alternative_titles']['titles'], new Movie\AlternativeTitle())
            );
        }

        if (array_key_exists('credits', $data)) {
            if (array_key_exists('cast', $data['credits'])) {
                $movie->getCredits()->setCast($this->getCastFactory()->createCollection($data['credits']['cast']));
            }

            if (array_key_exists('crew', $data['credits'])) {
                $movie->getCredits()->setCrew($this->getCrewFactory()->createCollection($data['credits']['crew']));
            }
        }

        /** Genres */
        if (array_key_exists('genres', $data)) {
            $movie->setGenres($this->getGenreFactory()->createCollection($data['genres']));
        }

        /** Images */
        if (array_key_exists('backdrop_path', $data)) {
            $movie->setBackdropImage($this->getImageFactory()->createFromPath($data['backdrop_path'], 'backdrop_path'));
        }

        if (array_key_exists('images', $data)) {
            $movie->setImages($this->getImageFactory()->createCollectionFromMovie($data['images']));
        }

        if (array_key_exists('poster_path', $data)) {
            $movie->setPosterImage($this->getImageFactory()->createFromPath($data['poster_path'], 'poster_path'));
        }

        /** Keywords */
        if (array_key_exists('keywords', $data)) {
            $movie->setKeywords($this->createGenericCollection($data['keywords']['keywords'], new Movie\Keyword()));
        }

        if (array_key_exists('releases', $data)) {
            $movie->setReleases($this->createGenericCollection($data['releases']['countries'], new Movie\Release()));
        }

        /**
         * @TODO actually implement more providers? ( Can't seem to find any quicktime related trailers anyways? ). For now KISS
         */
        if (array_key_exists('trailers', $data)) {
            $movie->setTrailers($this->createGenericCollection($data['trailers']['youtube'], new Youtube()));
        }

        if (array_key_exists('translations', $data)) {
            $movie->setTranslations($this->createGenericCollection($data['translations']['translations'], new Translation()));
        }

        if (array_key_exists('similar_movies', $data)) {
            $movie->setSimilarMovies($this->createCollection($data['similar_movies']['results']));
        }

//        if (array_key_exists('reviews', $data)) {
//        }

//        if (array_key_exists('lists', $data)) {
//        }

//        if (array_key_exists('changes', $data)) {
//        }

        return $this->hydrate($movie, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = array())
    {
        $collection = new GenericCollection();

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    /**
     * @param \Tmdb\Factory\People\CastFactory $castFactory
     * @return $this
     */
    public function setCastFactory($castFactory)
    {
        $this->castFactory = $castFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\People\CastFactory
     */
    public function getCastFactory()
    {
        return $this->castFactory;
    }

    /**
     * @param \Tmdb\Factory\People\CrewFactory $crewFactory
     * @return $this
     */
    public function setCrewFactory($crewFactory)
    {
        $this->crewFactory = $crewFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\People\CrewFactory
     */
    public function getCrewFactory()
    {
        return $this->crewFactory;
    }

    /**
     * @param \Tmdb\Factory\GenreFactory $genreFactory
     * @return $this
     */
    public function setGenreFactory($genreFactory)
    {
        $this->genreFactory = $genreFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\GenreFactory
     */
    public function getGenreFactory()
    {
        return $this->genreFactory;
    }

    /**
     * @param \Tmdb\Factory\ImageFactory $imageFactory
     * @return $this
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\ImageFactory
     */
    public function getImageFactory()
    {
        return $this->imageFactory;
    }


}