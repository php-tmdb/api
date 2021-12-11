<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author sheriffmarley
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\Model\Tv;

use Tmdb\Model\Network;
use Tmdb\Model\AbstractModel;

/**
 * Class EpisodeGroups
 * @package Tmdb\Model\Tv
 */
class EpisodeGroups extends AbstractModel
{

    public const ORIGINAL_AIR_DATE = 1;
    public const ABSOLUTE = 2;
    public const DVD = 3;
    public const DIGITAL = 4;
    public const STORY_ARC = 5;
    public const PRODUCTION = 6;
    public const TV = 7;

    /**
     * Properties that are available in the API
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'description',
        'episode_count',
        'group_count',
        'id',
        'name',
        'type'
    ];


    /**
     * @var string
     */
    private $description;
    /**
     * @var integer
     */
    private $episodeCount;
    /**
     * @var integer
     */
    private $groupCount;
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var null|Network
     */
    private $network;
    /**
     * @var integer
     */
    private $type;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return EpisodeGroups
     */
    public function setDescription(string $description): EpisodeGroups
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodeCount(): int
    {
        return $this->episodeCount;
    }

    /**
     * @param int $episodeCount
     * @return EpisodeGroups
     */
    public function setEpisodeCount(int $episodeCount): EpisodeGroups
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getGroupCount(): int
    {
        return $this->groupCount;
    }

    /**
     * @param int $groupCount
     * @return EpisodeGroups
     */
    public function setGroupCount(int $groupCount): EpisodeGroups
    {
        $this->groupCount = $groupCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return EpisodeGroups
     */
    public function setId(string $id): EpisodeGroups
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return EpisodeGroups
     */
    public function setName(string $name): EpisodeGroups
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Network|null
     */
    public function getNetwork(): ?Network
    {
        return $this->network;
    }

    /**
     * @param Network|null $network
     * @return EpisodeGroups
     */
    public function setNetwork(?Network $network): EpisodeGroups
    {
        $this->network = $network;

        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return EpisodeGroups
     */
    public function setType(int $type): EpisodeGroups
    {
        $this->type = $type;

        return $this;
    }
}
