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
use Tmdb\Exception\RuntimeException;
use Tmdb\Model\Common\Genres;
use Tmdb\Model\Common\Images;
use Tmdb\Model\Common\People;

class AbstractModel {
    protected static $_properties;

    protected $_data = array();
    protected $_client = null;

    /**
     * Retrieve the client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Set the client
     *
     * @param Client $client
     * @return $this
     */
    public function setClient(Client $client = null)
    {
        if (null !== $client) {
            $this->_client = $client;
        }

        return $this;
    }

    /**
     * Call a part of the API
     *
     * @param $api
     * @return mixed
     */
    public function api($api)
    {
        return $this->getClient()->api($api);
    }

    /**
     * Hydrate the object with data
     *
     * @param array $data
     * @return $this
     * @throws \Tmdb\Exception\RuntimeException
     */
    public function hydrate(array $data = array())
    {
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (in_array($k, static::$_properties)) {

                    $method = $this->camelize(
                        sprintf('set_%s', $k)
                    );

                    if (!method_exists($this, $method)) {
                        throw new RuntimeException(sprintf(
                            'Trying to call method "%s" on "%s" but it does not exist or is private.',
                            $method,
                            get_class($this)
                        ));
                    }

                    $this->$method($v);
                }
            }
        }

        return $this;
    }

    /**
     * Collect all images from an `image` array ( containing e.g. posters / profiles etc. )
     *
     * @param $client
     * @param array $collection
     * @return Images
     */
    protected function collectImages($client, array $collection = array())
    {
        $images = new Images();

        foreach($collection as $collectionName => $itemCollection) {
            foreach($itemCollection as $item) {
                if (!is_array($item)) {
                    continue;
                }

                $image = Image::fromArray($client, $item);

                $image->setType(Image::getTypeFromCollectionName($collectionName));

                $images->addImage($image);
            }
        }

        return $images;
    }

    /**
     * Collect all people from an array
     *
     * @param $client
     * @param array $collection
     * @return People
     */
    protected function collectPeople($client, array $collection = array())
    {
        $people = new People();

        foreach($collection as $item) {
            $person = Person::fromArray($client, $item);

            $people->addPerson($person);
        }

        return $people;
    }

    /**
     * Collect all people from an array
     *
     * @param $client
     * @param array $collection
     * @return People
     */
    protected function collectGenres($client, array $collection = array())
    {
        $genres = new Genres();

        foreach($collection as $item) {
            $genre = Genre::fromArray($client, $item);
            $genres->addGenre($genre);
        }

        return $genres;
    }

    /**
     * Transforms an under_scored_string to a camelCasedOne
     *
     * @see https://gist.github.com/troelskn/751517
     *
     * @param $candidate
     * @return string
     */
    private function camelize($candidate)
    {
        return lcfirst(
            implode('',
                array_map('ucfirst',
                    array_map('strtolower',
                        explode('_', $candidate
                        )
                    )
                )
            )
        );
    }

    /**
     * Transforms a camelCasedString to an under_scored_one
     *
     * @see https://gist.github.com/troelskn/751517
     *
     * @param $camelized
     * @return string
     */
    private function uncamelize($camelized) {
        return implode('_',
            array_map('strtolower',
                preg_split('/([A-Z]{1}[^A-Z]*)/', $camelized, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY)
            )
        );
    }

}