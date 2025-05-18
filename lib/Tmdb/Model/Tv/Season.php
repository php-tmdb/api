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

namespace Tmdb\Model\Tv;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\Changes;
use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\PosterImage;

/**
 * Class Season.
 */
class Season extends AbstractModel
{
    /**
     * Properties that are available in the API.
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'air_date',
        'name',
        'overview',
        'id',
        'poster_path',
        'season_number',
    ];
    /**
     * Credits.
     * @var CreditsCollection|mixed
     */
    protected $credits;
    /**
     * External Ids.
     * @var ExternalIds|mixed
     */
    protected $externalIds;
    /**
     * Images.
     * @var Images|mixed
     */
    protected $images;
    /**
     * @var PosterImage
     */
    protected $poster;
    /**
     * @var Videos|ResultCollection|mixed
     */
    protected $videos;
    /**
     * @var Changes|mixed
     */
    protected $changes;
    private ?\DateTime $airDate = null;
    /**
     * @var GenericCollection|Episode[]
     */
    private \Tmdb\Model\Common\GenericCollection $episodes;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $overview;
    private ?int $id = null;
    /**
     * @var string
     */
    private $posterPath;
    /**
     * @var int
     */
    private $seasonNumber;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->credits = new CreditsCollection();
        $this->externalIds = new ExternalIds();
        $this->images = new Images();
        $this->episodes = new GenericCollection();
        $this->videos = new Videos();
        $this->changes = new Changes();
    }

    /**
     * @return DateTime
     */
    public function getAirDate()
    {
        return $this->airDate;
    }

    /**
     * @param string $airDate
     */
    public function setAirDate($airDate): static
    {
        $this->airDate = new DateTime($airDate);

        return $this;
    }

    /**
     * @return GenericCollection|Episode[]
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * @param GenericCollection $episodes
     */
    public function setEpisodes($episodes): static
    {
        $this->episodes = $episodes;

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
     * @return int
     */
    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    /**
     * @param int $seasonNumber
     */
    public function setSeasonNumber($seasonNumber): static
    {
        $this->seasonNumber = $seasonNumber;

        return $this;
    }

    /**
     * @return CreditsCollection
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param CreditsCollection $credits
     */
    public function setCredits($credits): static
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * @return ExternalIds
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    /**
     * @param ExternalIds $externalIds
     */
    public function setExternalIds($externalIds): static
    {
        $this->externalIds = $externalIds;

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
     */
    public function setImages($images): static
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @param PosterImage $poster
     */
    public function setPosterImage($poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return ?PosterImage
     */
    public function getPosterImage()
    {
        return $this->poster;
    }

    /**
     * @return Videos
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Videos $videos
     */
    public function setVideos($videos): static
    {
        $this->videos = $videos;

        return $this;
    }

    /**
     * @return Changes
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * @param Changes $changes
     */
    public function setChanges($changes): static
    {
        $this->changes = $changes;

        return $this;
    }
}
