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

use Tmdb\Model\Collection\Images;
use Tmdb\Model\Image;

class ImageFactory extends AbstractFactory
{
    /**
     * Convert an array to an hydrated object
     *
     * @param array $data
     * @param string|null $key
     * @return Image
     */
    public static function create(array $data = array(), $key = null)
    {
        $type = self::resolveImageType($key);

        if (is_string($data)) {
            $data = array(
                'file_path' => $data
            );
        }

        return parent::hydrate($type, $data);
    }

    /**
     * Create an image instance based on the path and type, e.g.
     *
     * '/xkQ5yWnMjpC2bGmu7GsD66AAoKO.jpg', 'backdrop_path'
     *
     * @param $path
     * @param string $key
     * @return Image
     */
    public static function createFromPath($path, $key)
    {
        return parent::hydrate(
            self::resolveImageType($key),
            array('file_path' => $path)
        );
    }

    /**
     * Return possible image type keys
     *
     * @return string[]
     */
    public static function getPossibleKeys()
    {
        return array(
            'poster',
            'posters',
            'poster_path',
            'backdrop',
            'backdrops',
            'backdrop_path',
            'profile',
            'profiles',
            'profile_path',
            'logo',
            'logos',
            'logo_path',
        );
    }

    /**
     * @param string|null $key
     * @return Image|Image\BackdropImage|Image\LogoImage|Image\PosterImage|Image\ProfileImage|Image\StillImage
     */
    private function resolveImageType($key = null)
    {
        switch($key) {
            case 'poster':
            case 'posters':
            case 'poster_path':
                $object = new Image\PosterImage();
                break;

            case 'backdrop':
            case 'backdrops':
            case 'backdrop_path':
                $object = new Image\BackdropImage();
                break;

            case 'profile':
            case 'profiles':
            case 'profile_path':
                $object = new Image\ProfileImage();
                break;

            case 'logo':
            case 'logos':
            case 'logo_path':
                $object = new Image\LogoImage();
                break;

            case 'still':
            case 'stills':
            case 'still_path':
                $object = new Image\StillImage();
                break;

            case 'file_path':
            default:
                $object = new Image();
                break;
        }

        return $object;
    }

    /**
     * Create generic collection
     *
     * @param array $data
     * @return Images
     */
    public static function createCollection(array $data = array())
    {
        $collection = new Images();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }

    /**
     * Create full collection
     *
     * @param array $data
     * @return Images
     */
    public static function createImageCollection(array $data = array())
    {
        $collection = new Images();

        foreach($data as $format => $formatCollection) {
            foreach($formatCollection as $item) {
                if (array_key_exists($format, Image::$_formats)) {
                    $item = self::create($item, $format);

                    $collection->add(null, $item);
                }
            }
        }

        return $collection;
    }

    /**
     * Create full movie collection
     *
     * @param array $data
     * @return Images
     */
    public static function createCollectionFromMovie(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * Create full tv show collection
     *
     * @param array $data
     * @return Images
     */
    public static function createCollectionFromTv(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * Create full tv season collection
     *
     * @param array $data
     * @return Images
     */
    public static function createCollectionFromTvSeason(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * Create full tv episode collection
     *
     * @param array $data
     * @return Images
     */
    public static function createCollectionFromTvEpisode(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * Create full people collection
     *
     * @param array $data
     * @return Images
     */
    public static function createCollectionFromPeople(array $data = array())
    {
        return self::createImageCollection($data);
    }

}