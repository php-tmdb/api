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
namespace Tmdb\Model\Common;

use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Collection\People;
use Tmdb\Model\Common\Collection\Images;
use Tmdb\Model\Genre;
use Tmdb\Model\Image;
use Tmdb\Model\Person;

class DataCollector {

    /**
     * Collect all images from an `image` array ( containing e.g. posters / profiles etc. )
     *
     * @param $client
     * @param array $collection
     * @return Image[]
     */
    public function collectImages($client, array $collection = array())
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
     * @return Person[]
     */
    public function collectPeople($client, array $collection = array())
    {
        $people = new People();

        foreach($collection as $item) {
            $person = Person::fromArray($client, $item);

            $people->addPerson($person);
        }

        return $people;
    }

    /**
     * Collect cast
     *
     * @param $client
     * @param array $collection
     * @return CastMember[]
     */
    public function collectCast($client, array $collection = array())
    {
        $people = new Cast();

        foreach($collection as $item) {
            $person = CastMember::fromArray($client, $item);

            $people->addPerson($person);
        }

        return $people;
    }

    /**
     * Collect crew
     *
     * @param $client
     * @param array $collection
     * @return CrewMember[]
     */
    public function collectCrew($client, array $collection = array())
    {
        $people = new Crew();

        foreach($collection as $item) {
            $person = CrewMember::fromArray($client, $item);

            $people->addPerson($person);
        }

        return $people;
    }

    /**
     * Collect all genres from an array
     *
     * @param $client
     * @param array $collection
     * @return Genre[]
     */
    public function collectGenres($client, array $collection = array())
    {
        $genres = new Genres();

        foreach($collection as $item) {
            $genre = Genre::fromArray($client, $item);
            $genres->addGenre($genre);
        }

        return $genres;
    }

    /**
     * Collect all genres from an array
     *
     * @param $client
     * @param array $collection
     * @param object $object
     * @return GenericCollection
     */
    public function collectGenericCollection($client, array $collection = array(), $object)
    {
        $collectionObject = new GenericCollection();

        foreach($collection as $item) {
            $class = get_class($object);
            $model = $class::fromArray($client, $item);

            $collectionObject->add(null, $model);
        }

        return $collectionObject;
    }
} 