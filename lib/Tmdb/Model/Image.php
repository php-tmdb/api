<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Model;

use Tmdb\Model\Filter\ImageFilter;
use Tmdb\Model\Filter\LanguageFilter;

/**
 * Class Image.
 */
class Image extends AbstractModel implements ImageFilter, LanguageFilter, \Stringable
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
        'vote_count',
    ];
    public static $formats = [
        'posters' => self::FORMAT_POSTER,
        'backdrops' => self::FORMAT_BACKDROP,
        'profiles' => self::FORMAT_PROFILE,
        'logos' => self::FORMAT_LOGO,
        'stills' => self::FORMAT_STILL,
    ];
    protected $id;
    protected $type;
    private $filePath;
    private ?int $width = null;
    private ?int $height = null;
    private $iso6391;
    private ?float $aspectRatio = null;
    private ?float $voteAverage = null;
    private ?int $voteCount = null;
    private $media;

    /**
     * Get the singular type as defined in $_types.
     */
    public static function getTypeFromCollectionName($name)
    {
        if (\array_key_exists($name, self::$formats)) {
            return self::$formats[$name];
        }

        return null;
    }

    /**
     * @return ?float
     */
    public function getAspectRatio()
    {
        return $this->aspectRatio;
    }

    /**
     * @param float $aspectRatio
     */
    public function setAspectRatio($aspectRatio): static
    {
        $this->aspectRatio = (float) $aspectRatio;

        return $this;
    }

    /**
     * @return ?int
     */
    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height): static
    {
        $this->height = (int) $height;

        return $this;
    }

    #[\Override]
    public function getIso6391()
    {
        return $this->iso6391;
    }

    public function setIso6391($iso6391): static
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
     */
    public function setVoteAverage($voteAverage): static
    {
        $this->voteAverage = (float) $voteAverage;

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
     */
    public function setVoteCount($voteCount): static
    {
        $this->voteCount = (int) $voteCount;

        return $this;
    }

    /**
     * @return ?int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width): static
    {
        $this->width = (int) $width;

        return $this;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setMedia($media): static
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Return the file path when casted to string.
     */
    #[\Override]
    public function __toString(): string
    {
        return (string) $this->getFilePath();
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function setFilePath($filePath): static
    {
        $this->filePath = $filePath;

        return $this;
    }
}
