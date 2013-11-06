<?php
/**
 * This file is part of the Wrike PHP API created by B-Found IM&S.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @package Wrike
 * @author Michael Roterman <michael@b-found.nl>
 * @copyright (c) 2013, B-Found Internet Marketing & Services
 * @version 0.0.1
 */

namespace Tmdb\Factory;

use Tmdb\Model\Movie;

class MovieFactory {
    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @return $this
     */
    public static function create(array $data = array())
    {
        if (!$data) {
            return null;
        }

        $movie = new Movie($data['id']);

//        if (array_key_exists('alternative_titles', $data) && array_key_exists('titles', $data['alternative_titles'])) {
//            $movie->setAlternativeTitles(Movie::collectGenericCollection($client, $data['alternative_titles']['titles'], new AlternativeTitle()));
//        }
//
//        $casts   = array();
//        $credits = $movie->getCredits();
//
//        /** Credits */
//        if (array_key_exists('credits', $data)) {
//            $casts = $data['credits'];
//        }
//
//        if (array_key_exists('casts', $data)) {
//            $casts = $data['casts'];
//        }
//
//        if (array_key_exists('cast', $casts)) {
//            $credits->setCast(parent::collectCast($client, $casts['cast']));
//        }
//
//        if (array_key_exists('crew', $casts)) {
//            $credits->setCrew(parent::collectCrew($client, $casts['crew']));
//        }
//
//        $movie->setCredits($credits);
//
        /** Genres */
        if (array_key_exists('genres', $data)) {
            $movie->setGenres(parent::collectGenres($client, $data['genres']));
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

        return $movie->hydrate($data);
    }

} 