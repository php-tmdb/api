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

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\PosterImage;

/**
 * Class Lists.
 */
class Lists extends AbstractModel
{
    public static $properties = [
        'created_by',
        'description',
        'favorite_count',
        'id',
        'item_count',
        'iso_639_1',
        'name',
        'poster_path',
    ];
    /**
     * @var string
     */
    private $createdBy;
    /**
     * @var string
     */
    private $description;
    /**
     * @var int
     */
    private $favoriteCount;
    /**
     * @var string
     */
    private $id;
    private \Tmdb\Model\Common\GenericCollection $items;
    /**
     * @var int
     */
    private $itemCount;
    /**
     * @var string
     */
    private $iso6391;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $posterPath;
    /**
     * @var PosterImage
     */
    private $posterImage;

    public function __construct()
    {
        $this->items = new GenericCollection();
    }

    /**
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     */
    public function setCreatedBy($createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getFavoriteCount()
    {
        return $this->favoriteCount;
    }

    /**
     * @param int $favoriteCount
     */
    public function setFavoriteCount($favoriteCount): static
    {
        $this->favoriteCount = $favoriteCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param string $iso6391
     */
    public function setIso6391($iso6391): static
    {
        $this->iso6391 = $iso6391;

        return $this;
    }

    /**
     * @return int
     */
    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * @param int $itemCount
     */
    public function setItemCount($itemCount): static
    {
        $this->itemCount = $itemCount;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param GenericCollection $items
     */
    public function setItems($items): static
    {
        $this->items = $items;

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
     * @param string $name
     */
    public function setName($name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return PosterImage
     */
    public function getPosterImage()
    {
        return $this->posterImage;
    }

    /**
     * @param PosterImage $posterImage
     */
    public function setPosterImage($posterImage): static
    {
        $this->posterImage = $posterImage;

        return $this;
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
