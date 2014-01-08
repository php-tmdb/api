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
namespace Tmdb\Factory\Common;

use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Common\Collection\Images;
use Tmdb\Model\Image;

class ImageFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        return parent::hydrate(new Image(), $data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollection(array $data = array())
    {
        $collection     = new Images();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public static function createImageCollection(array $data = array())
    {
        $collection = array();

        foreach($data as $format => $formatCollection) {
            foreach($formatCollection as $item) {
                if (array_key_exists($format, Image::$_formats)) {
                    $item['format'] = Image::$_formats[$format];

                    $collection[] = $item;
                }
            }
        }

        return self::createCollection($collection);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollectionFromMovie(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollectionFromPeople(array $data = array())
    {
        return self::createImageCollection($data);
    }

}