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

namespace Tmdb\Model\Person;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Image\PosterImage;

/**
 * Class MovieCredit
 * @package Tmdb\Model\Person
 */
class Credit extends AbstractModel
{
    public static $properties = array(
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
        'first_air_date'
    );
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
    /**
     * @var DateTime
     */
    private $releaseDate;
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
    /**
     * @var mixed
     */
    private $firstAirDate;

    /**
     * @return boolean
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param boolean $adult
     * @return self
     */
    public function setAdult($adult)
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
     * @return self
     */
    public function setCharacter($character)
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
     * @return self
     */
    public function setCreditId($creditId)
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
     * @return self
     */
    public function setId($id)
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
     * @return self
     */
    public function setOriginalTitle($originalTitle)
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
     * @return self
     */
    public function setPosterImage($posterImage)
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
     * @return self
     */
    public function setPosterPath($posterPath)
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
     * @return self
     */
    public function setReleaseDate($releaseDate = null)
    {
        if (!$releaseDate instanceof DateTime && $releaseDate !== null) {
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
     * @return self
     */
    public function setTitle($title)
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
     * @return self
     */
    public function setJob($job)
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
     * @return self
     */
    public function setDepartment($department)
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
     * @return self
     */
    public function setOriginalName($originalName)
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
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     * @return self
     */
    public function setMediaType($mediaType)
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
     * @return self
     */
    public function setEpisodeCount($episodeCount)
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstAirDate()
    {
        return $this->firstAirDate;
    }

    /**
     * @param mixed $firstAirDate
     * @return self
     */
    public function setFirstAirDate($firstAirDate)
    {
        $this->firstAirDate = $firstAirDate;

        return $this;
    }
}
