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
 * @version 4.0.0
 */

namespace Tmdb\Model;

use Tmdb\Model\Filter\ImageFilter;
use Tmdb\Model\Filter\LanguageFilter;

/**
 * Class Image
 * @package Tmdb\Model
 */
class Image extends AbstractModel implements ImageFilter, LanguageFilter
{
    public const FORMAT_POSTER = 'poster';
    public const FORMAT_BACKDROP = 'backdrop';
    public const FORMAT_PROFILE = 'profile';
    public const FORMAT_LOGO = 'logo';
    public const FORMAT_STILL = 'still';
    public static $properties = [
        'file_path',
        'width',
        'height',
        'iso_639_1',
        'aspect_ratio',
        'vote_average',
        'vote_count'
    ];
    public static $formats = [
        'posters' => self::FORMAT_POSTER,
        'backdrops' => self::FORMAT_BACKDROP,
        'profiles' => self::FORMAT_PROFILE,
        'logos' => self::FORMAT_LOGO,
        'stills' => self::FORMAT_STILL
    ];
    protected $id;
    protected $type;
    private $filePath;
    private $width;
    private $height;
    private $iso6391;
    private $aspectRatio;
    private $voteAverage;
    private $voteCount;
    private $media;

    /**
     * Get the singular type as defined in $_types
     *
     * @param $name
     * @return mixed
     */
    public static function getTypeFromCollectionName($name)
    {
        if (array_key_exists($name, self::$formats)) {
            return self::$formats[$name];
        }

        return null;
    }

    /**
     * @return float
     */
    public function getAspectRatio()
    {
        return $this->aspectRatio;
    }

    /**
     * @param float $aspectRatio
     * @return self
     */
    public function setAspectRatio($aspectRatio)
    {
        $this->aspectRatio = (float)$aspectRatio;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     * @return self
     */
    public function setHeight($height)
    {
        $this->height = (int)$height;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param mixed $iso6391
     * @return self
     */
    public function setIso6391($iso6391)
    {
        $this->iso6391 = $iso6391;

        return $this;
    }

    /**
     * @return float
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    /**
     * @param float $voteAverage
     * @return self
     */
    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = (float)$voteAverage;

        return $this;
    }

    /**
     * @return int
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * @param int $voteCount
     * @return self
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = (int)$voteCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return self
     */
    public function setWidth($width)
    {
        $this->width = (int)$width;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param mixed $media
     * @return self
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Return the file path when casted to string
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getFilePath();
    }

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param mixed $filePath
     * @return self
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }
}
