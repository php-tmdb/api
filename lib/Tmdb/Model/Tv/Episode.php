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

namespace Tmdb\Model\Tv;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\Changes;
use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\PosterImage;
use Tmdb\Model\Image\StillImage;

/**
 * Class Episode
 * @package Tmdb\Model\Tv
 */
class Episode extends AbstractModel
{
    /**
     * Properties that are available in the API
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'air_date',
        'episode_number',
        'name',
        'overview',
        'id',
        'production_code',
        'season_number',
        'still_path',
        'vote_average',
        'vote_count'
    ];
    /**
     * Credits
     *
     * @var CreditsCollection
     */
    protected $credits;
    /**
     * External Ids
     *
     * @var ExternalIds
     */
    protected $externalIds;
    /**
     * Images
     *
     * @var Images
     */
    protected $images;
    /**
     * @var GenericCollection
     */
    protected $translations;
    /**
     * @var StillImage
     */
    protected $still;
    /**
     * @var Videos
     */
    protected $videos;

    /**
     * @var \DateTime|null
     */
    private $airDate;

    /**
     * @var Changes
     */
    protected $changes;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $overview;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $productionCode;

    /**
     * @var string
     */
    private $stillPath;

    /**
     * @var integer
     */
    private $seasonNumber;

    /**
     * @var integer
     */
    private $episodeNumber;

    /**
     * @var float
     */
    private $voteAverage;

    /**
     * @var integer
     */
    private $voteCount;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->credits = new CreditsCollection();
        $this->externalIds = new ExternalIds();
        $this->images = new Images();
        $this->translations = new GenericCollection();
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
     * @param DateTime $airDate
     * @return $this
     */
    public function setAirDate($airDate)
    {
        if (!$airDate instanceof DateTime) {
            $airDate = new DateTime($airDate);
        }

        $this->airDate = $airDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    /**
     * @param int $episodeNumber
     * @return $this
     */
    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = (int)$episodeNumber;

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
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (int)$id;

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
     * @return $this
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
     * @return $this
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductionCode()
    {
        return $this->productionCode;
    }

    /**
     * @param string $productionCode
     * @return $this
     */
    public function setProductionCode($productionCode)
    {
        $this->productionCode = $productionCode;

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
     * @return $this
     */
    public function setSeasonNumber($seasonNumber)
    {
        $this->seasonNumber = (int)$seasonNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getStillPath()
    {
        return $this->stillPath;
    }

    /**
     * @param string $stillPath
     * @return $this
     */
    public function setStillPath($stillPath)
    {
        $this->stillPath = $stillPath;

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
     * @return $this
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
     * @return $this
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = (int)$voteCount;

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
     * @return $this
     */
    public function setCredits($credits)
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
     * @return $this
     */
    public function setExternalIds($externalIds)
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
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;

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
     * @param GenericCollection $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @param StillImage $still
     * @return $this
     */
    public function setStillImage($still)
    {
        $this->still = $still;

        return $this;
    }

    /**
     * @return StillImage
     */
    public function getStillImage()
    {
        return $this->still;
    }

    /**
     * @return Videos
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Videos|ResultCollection $videos
     * @return $this
     */
    public function setVideos($videos)
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
     * @return $this
     */
    public function setChanges($changes)
    {
        $this->changes = $changes;

        return $this;
    }
}
