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

use Tmdb\Client;
use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Genre;

class GenreFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        return parent::hydrate(new Genre(), $data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollection(array $data = array())
    {
        $collection = new Genres();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }

    /**
     * Load a genre with the given identifier
     *
     * @param Client $client
     * @param $id
     * @param $parameters
     * @return $this
     */
    public static function load(Client $client, $id, array $parameters = array()) {
        $data = $client->api('genres')->getGenre($id, parent::parseQueryParameters($parameters));

        return self::create($data);
    }

} 