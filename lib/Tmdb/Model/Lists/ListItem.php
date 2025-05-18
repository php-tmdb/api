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

namespace Tmdb\Model\Lists;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Image\BackdropImage;
use Tmdb\Model\Image\PosterImage;

/**
 * Class ListItem.
 */
class ListItem extends AbstractModel
{
    /**
     * @var array
     */
    public static $properties = [
        'backdrop_path',
        'id',
        'original_title',
        'release_date',
        'poster_path',
        'title',
        'vote_average',
        'vote_count',
    ];
    /**
     * @var string
     */
    private $backdropPath;
    /**
     * @var BackdropImage
     */
    private $backdropImage;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $originalTitle;
    /**
     * @var DateTime
     */
    private $releaseDate;
    /**
     * @var string
     */
    private $posterPath;
    /**
     * @var PosterImage
     */
    private $posterImage;
    /**
     * @var string
     */
    private $title;
    /**
     * @var float
     */
    private $voteAverage;
    /**
     * @var int
     */
    private $voteCount;

    /**
     * @return BackdropImage
     */
    public function getBackdropImage()
    {
        return $this->backdropImage;
    }

    /**
     * @param BackdropImage $backdropImage
     */
    public function setBackdropImage($backdropImage): static
    {
        $this->backdropImage = $backdropImage;

        return $this;
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
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * @param string $originalTitle
     */
    public function setOriginalTitle($originalTitle): static
    {
        $this->originalTitle = $originalTitle;

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

    /**
     * @return DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param DateTime $releaseDate
     */
    public function setReleaseDate($releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): static
    {
        $this->title = $title;

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
        $this->voteAverage = $voteAverage;

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
        $this->voteCount = $voteCount;

        return $this;
    }
}
