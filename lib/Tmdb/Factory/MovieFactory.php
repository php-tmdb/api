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

use Tmdb\Factory\Common\GenericCollectionFactory;
use Tmdb\Factory\People\CastFactory;
use Tmdb\Factory\People\CrewFactory;
use Tmdb\Model\Common\Collection;
use Tmdb\Model\Common\Trailer\Youtube;
use Tmdb\Model\Common\Translation;
use Tmdb\Model\Movie;

class MovieFactory extends AbstractFactory {
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        if (!$data) {
            return null;
        }

        $movie = new Movie();

        if (array_key_exists('alternative_titles', $data) && array_key_exists('titles', $data['alternative_titles'])) {
            $movie->setAlternativeTitles(
                GenericCollectionFactory::createCollection($data['alternative_titles']['titles'], new Movie\AlternativeTitle())
            );
        }

        if (array_key_exists('credits', $data)) {
            if (array_key_exists('cast', $data['credits'])) {
                $movie->getCredits()->setCast(CastFactory::createCollection($data['credits']['cast']));
            }

            if (array_key_exists('crew', $data['credits'])) {
                $movie->getCredits()->setCrew(CrewFactory::createCollection($data['credits']['crew']));
            }
        }

        /** Genres */
        if (array_key_exists('genres', $data)) {
            $movie->setGenres(GenreFactory::createCollection($data['genres']));
        }

        /** Images */
        if (array_key_exists('images', $data)) {
            $movie->setImages(ImageFactory::createCollectionFromMovie($data['images']));
        }

        /** Keywords */
        if (array_key_exists('keywords', $data)) {
            $movie->setKeywords(GenericCollectionFactory::createCollection($data['keywords']['keywords'], new Movie\Keyword()));
        }

        if (array_key_exists('releases', $data)) {
            $movie->setReleases(GenericCollectionFactory::createCollection($data['releases']['countries'], new Movie\Release()));
        }

        /**
         * @TODO actually implement more providers? ( Can't seem to find any quicktime related trailers anyways? ). For now KISS
         */
        if (array_key_exists('trailers', $data)) {
            $movie->setTrailers(GenericCollectionFactory::createCollection($data['trailers']['youtube'], new Youtube()));
        }

        if (array_key_exists('translations', $data)) {
            $movie->setTranslations(GenericCollectionFactory::createCollection($data['translations']['translations'], new Translation()));
        }

        if (array_key_exists('similar_movies', $data)) {
            $movie->setSimilarMovies(GenericCollectionFactory::createCollection($data['similar_movies']['results'], new Movie()));
        }

//        if (array_key_exists('reviews', $data)) {
//        }

//        if (array_key_exists('lists', $data)) {
//        }

//        if (array_key_exists('changes', $data)) {
//        }

        return parent::hydrate($movie, $data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollection(array $data = array())
    {
        $collection = new Collection();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }
}