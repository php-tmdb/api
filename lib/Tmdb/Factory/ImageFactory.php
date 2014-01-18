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
     * {@inheritdoc}
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
     * @param $key
     * @return \Tmdb\Model\Image
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
     * @return array
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public static function createCollectionFromMovie(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollectionFromTv(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollectionFromTvSeason(array $data = array())
    {
        return self::createImageCollection($data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollectionFromTvEpisode(array $data = array())
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