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
namespace Tmdb\Repository;

use Tmdb\Factory\GenreFactory;
use Tmdb\Model\Common\Collection;
use Tmdb\Model\Genre;

class GenreRepository extends AbstractRepository {
    /**
     * Load a genre with the given identifier
     *
     * @param $id
     * @param array $parameters
     * @param array $headers
     * @return Genre
     */
    public function load($id, array $parameters = array(), array $headers = array()) {
        $data = $this->getApi()->getGenre($id, $this->parseQueryParameters($parameters), $this->parseHeaders($headers));

        return GenreFactory::create($data);
    }

    /**
     * If you obtained an person model which is not completely hydrated, you can use this function.
     *
     * @param Genre $genre
     * @param array $parameters
     * @param array $headers
     * @return Genre
     */
    public function refresh(Genre $genre, array $parameters = array(), array $headers = array()) {
        return $this->load($genre->getId(), $parameters, $headers);
    }

    /**
     * Get the list of genres.
     *
     * @param array $options
     * @return Collection
     */
    public function loadCollection(array $options = array())
    {
        return $this->createCollection(
            $this->getApi()->getGenres($options)
        );
    }

    /**
     * Create an collection of an array
     *
     * @param $data
     * @return Collection
     */
    private function createCollection($data){
        $collection = new Collection();

        if (array_key_exists('genres', $data)) {
            $data = $data['genres'];
        }

        foreach($data as $item) {
            $collection->add(null, GenreFactory::create($item));
        }

        return $collection;
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\Genres
     */
    public function getApi()
    {
        return $this->getClient()->getGenresApi();
    }
}