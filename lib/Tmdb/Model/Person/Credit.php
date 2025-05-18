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

namespace Tmdb\Model\Person;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Image\PosterImage;

/**
 * Class MovieCredit.
 */
class Credit extends AbstractModel
{
    public static $properties = [
        'adult',
        'character',
        'credit_id',
        'id',
        'original_title',
        'poster_path',
        'release_date',
        'title',
        'job',
        'department',
        'original_name',
        'name',
        'media_type',
        'episode_count',
        'first_air_date',
    ];
    /**
     * @var bool
     */
    private $adult;
    /**
     * @var string
     */
    private $character;
    /**
     * @var string
     */
    private $creditId;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $originalTitle;
    /**
     * @var string
     */
    private $posterPath;
    private ?\DateTime $releaseDate = null;
    /**
     * @var string
     */
    private $title;
    /**
     * @var PosterImage
     */
    private $posterImage;
    /**
     * @var string
     */
    private $job;
    /**
     * @var string
     */
    private $department;
    /**
     * @var string
     */
    private $mediaType;
    /**
     * @var string
     */
    private $originalName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $episodeCount;
    private $firstAirDate;

    /**
     * @return bool
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param bool $adult
     */
    public function setAdult($adult): static
    {
        $this->adult = $adult;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param string $character
     */
    public function setCharacter($character): static
    {
        $this->character = $character;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreditId()
    {
        return $this->creditId;
    }

    /**
     * @param string $creditId
     */
    public function setCreditId($creditId): static
    {
        $this->creditId = $creditId;

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
     * @param DateTime|string|null $releaseDate
     */
    public function setReleaseDate($releaseDate = null): static
    {
        if (!$releaseDate instanceof DateTime && null !== $releaseDate) {
            $releaseDate = new DateTime($releaseDate);
        }

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
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param string $job
     */
    public function setJob($job): static
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param string $department
     */
    public function setDepartment($department): static
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     */
    public function setOriginalName($originalName): static
    {
        $this->originalName = $originalName;

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
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     */
    public function setMediaType($mediaType): static
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodeCount()
    {
        return $this->episodeCount;
    }

    /**
     * @param int $episodeCount
     */
    public function setEpisodeCount($episodeCount): static
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    public function getFirstAirDate()
    {
        return $this->firstAirDate;
    }

    public function setFirstAirDate($firstAirDate): static
    {
        $this->firstAirDate = $firstAirDate;

        return $this;
    }
}
