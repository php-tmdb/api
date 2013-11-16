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

use Tmdb\Api\Movies;
use Tmdb\Client;
use Tmdb\Model\Common\Collection;
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

//        if (array_key_exists('alternative_titles', $data) && array_key_exists('titles', $data['alternative_titles'])) {
//            $movie->setAlternativeTitles(Movie::collectGenericCollection($client, $data['alternative_titles']['titles'], new AlternativeTitle()));
//        }

        $casts   = array();
        $credits = $movie->getCredits();

        /** Credits */
        if (array_key_exists('credits', $data)) {
            $casts = $data['credits'];
        }

        if (array_key_exists('casts', $data)) {
            $casts = $data['casts'];
        }

        if (array_key_exists('cast', $casts)) {
            $credits->setCast($casts['cast']);
        }

        if (array_key_exists('crew', $casts)) {
            $credits->setCrew($casts['crew']);
        }

        $movie->setCredits($credits);

        /** Genres */
        if (array_key_exists('genres', $data)) {
            $movie->setGenres(GenreFactory::createCollection($data['genres']));
        }
//
//        /** Images */
//        if (array_key_exists('images', $data)) {
//            $movie->setImages(parent::collectImages($client, $data['images']));
//        }
//
//        /** Keywords */
//        if (array_key_exists('keywords', $data)) {
//        }
//
//        if (array_key_exists('releases', $data)) {
//        }
//
//        if (array_key_exists('trailers', $data)) {
//        }
//
//        if (array_key_exists('translations', $data)) {
//        }
//
//        if (array_key_exists('similar_movies', $data)) {
//        }
//
//        if (array_key_exists('reviews', $data)) {
//        }
//
//        if (array_key_exists('lists', $data)) {
//        }
//
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

        return self::create($data);
    }

} 