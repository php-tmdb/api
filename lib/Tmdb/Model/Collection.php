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

use Tmdb\Model\Collection\Images;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\BackdropImage;
use Tmdb\Model\Image\PosterImage;

/**
 * Class Collection.
 */
class Collection extends AbstractModel
{
    /**
     * @var string
     */
    private $backdropPath;
    private ?\Tmdb\Model\Image\BackdropImage $backdrop = null;
    private ?int $id = null;
    private \Tmdb\Model\Collection\Images $images;

    private \Tmdb\Model\Common\GenericCollection $translations;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $overview;
    private \Tmdb\Model\Common\GenericCollection $parts;
    /**
     * @var string
     */
    private $posterPath;
    private ?\Tmdb\Model\Image\PosterImage $poster = null;

    public static $properties = [
        'backdrop_path',
        'id',
        'name',
        'overview',
        'poster_path',
    ];

    public function __construct()
    {
        $this->parts = new GenericCollection();
        $this->images = new Images();
        $this->translations = new GenericCollection();
    }

    public function setBackdropImage(BackdropImage $backdrop): static
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
     */
    public function setBackdropPath($backdropPath): static
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
     */
    public function setId($id): static
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return Images
     */
    public function getImages()
    {
        return $this->images;
    }

    public function setImages(Images $images): static
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
     * @param GenericCollection $translations
     */
    public function setTranslations($translations): static
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
     */
    public function setName($name): static
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
     */
    public function setOverview($overview): static
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
     */
    public function setParts($parts): static
    {
        $this->parts = $parts;

        return $this;
    }

    public function setPosterImage(PosterImage $poster): static
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
     */
    public function setPosterPath($posterPath): static
    {
        $this->posterPath = $posterPath;

        return $this;
    }
}
