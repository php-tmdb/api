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

use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Genre;

class GenreFactory {
    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @return $this
     */
    public static function create(array $data = array())
    {
        $genre = new Genre();

        return $genre->hydrate($data);
    }

    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @return Genre[]
     */
    public static function createCollection(array $data = array())
    {
        $collection = new Genres();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }

} 