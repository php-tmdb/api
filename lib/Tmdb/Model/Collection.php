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

use Tmdb\Model\Collection\Images;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\BackdropImage;
use Tmdb\Model\Image\PosterImage;

/**
 * Class Collection
 * @package Tmdb\Model
 */
class Collection extends AbstractModel
{
    /**
     * @var string
     */
    private $backdropPath;
    /**
     * @var BackdropImage
     */
    private $backdrop;
    /**
     * @var integer
     */
    private $id;
    /**
     * @var Images
     */
    private $images;

    /**
     * @var GenericCollection
     */
    private $translations;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $overview;
    /**
     * @var Common\GenericCollection
     */
    private $parts;
    /**
     * @var string
     */
    private $posterPath;
    /**
     * @var PosterImage
     */
    private $poster;

    public static $properties = [
        'backdrop_path',
        'id',
        'name',
        'overview',
        'poster_path',
    ];

    public function __construct()
    {
        $this->parts        = new GenericCollection();
        $this->images       = new Images();
        $this->translations = new GenericCollection();
    }

    /**
     * @param BackdropImage $backdrop
     * @return self
     */
    public function setBackdropImage(BackdropImage $backdrop)
    {
        $this->backdrop = $backdrop;

        return $this;
    }

    /**
     * @return BackdropImage
     */
    public function getBackdropImage()
    {
        return $this->backdrop;
    }

    /**
     * @return string
     */
    public function getBackdropPath()
    {
        return $this->backdropPath;
    }

    /**
     * @param string $backdropPath
     * @return self
     */
    public function setBackdropPath($backdropPath)
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

    /**
     * @return Images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Images $images
     * @return self
     */
    public function setImages(Images $images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  GenericCollection $translations
     * @return self
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
         return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     * @return self
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getParts()
    {
        return $this->parts;
    }

    /**
     * @param GenericCollection $parts
     * @return self
     */
    public function setParts($parts)
    {
        $this->parts = $parts;

        return $this;
    }

    /**
     * @param PosterImage $poster
     * @return self
     */
    public function setPosterImage(PosterImage $poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return PosterImage
     */
    public function getPosterImage()
    {
        return $this->poster;
    }

    /**
     * @return string
     */
    public function getPosterPath()
    {
        return $this->posterPath;
    }

    /**
     * @param string $posterPath
     * @return self
     */
    public function setPosterPath($posterPath)
    {
        $this->posterPath = $posterPath;

        return $this;
    }
}
