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
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\StillImage;

/**
 * Class Episode.
 */
class Episode extends AbstractModel
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
        'episode_number',
        'name',
        'overview',
        'id',
        'production_code',
        'season_number',
        'still_path',
        'vote_average',
        'vote_count',
        'show_id',
        'runtime',
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
     * @var GenericCollection|mixed
     */
    protected $translations;
    
    /**
     * @var StillImage
     */
    protected $still;
    
    /**
     * @var Videos|ResultCollection|mixed
     */
    protected $videos;

    private ?\DateTime $airDate = null;

    protected \Tmdb\Model\Collection\Changes $changes;

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
    private $productionCode;

    /**
     * @var string
     */
    private $stillPath;

    private ?int $seasonNumber = null;

    private ?int $episodeNumber = null;

    private ?float $voteAverage = null;

    private ?int $voteCount = null;

    /**
     * Only available in episode group.
     */
    private ?int $showId = null;
    private int $runtime;

    /**
     * Constructor.
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
     * @return ?DateTime
     */
    public function getAirDate()
    {
        return $this->airDate;
    }

    /**
     * @param DateTime|string|null $airDate
     */
    public function setAirDate($airDate = null): static
    {
        if (empty($airDate)) {
            $airDate = null;
        } elseif (!$airDate instanceof DateTime) {
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
     */
    public function setEpisodeNumber($episodeNumber): static
    {
        $this->episodeNumber = (int) $episodeNumber;

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
    public function getProductionCode()
    {
        return $this->productionCode;
    }

    /**
     * @param string $productionCode
     */
    public function setProductionCode($productionCode): static
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
     */
    public function setSeasonNumber($seasonNumber): static
    {
        $this->seasonNumber = (int) $seasonNumber;

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
     */
    public function setStillPath($stillPath): static
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
     * @return GenericCollection
     */
    public function getTranslations()
    {
        return $this->translations;
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
     * @param StillImage $still
     */
    public function setStillImage($still): static
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

    public function getShowId(): int
    {
        return $this->showId;
    }

    public function setShowId(int $showId): Episode
    {
        $this->showId = $showId;

        return $this;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }

    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }
}
