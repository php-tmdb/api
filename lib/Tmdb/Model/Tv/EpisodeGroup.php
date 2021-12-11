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
use Tmdb\Model\Common\GenericCollection;

/**
 * Class Season
 * @package Tmdb\Model\Tv
 */
class EpisodeGroup extends AbstractModel
{
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
        'type',
    ];

    /**
     * @var GenericCollection
     */
    protected $groups;

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
     * @return EpisodeGroup
     */
    public function setDescription(string $description): EpisodeGroup
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
     * @return EpisodeGroup
     */
    public function setEpisodeCount(int $episodeCount): EpisodeGroup
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
     * @return EpisodeGroup
     */
    public function setGroupCount(int $groupCount): EpisodeGroup
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
     * @return EpisodeGroup
     */
    public function setId(string $id): EpisodeGroup
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
     * @return EpisodeGroup
     */
    public function setName(string $name): EpisodeGroup
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
     * @return EpisodeGroup
     */
    public function setNetwork(?Network $network): EpisodeGroup
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
     * @return EpisodeGroup
     */
    public function setType(int $type): EpisodeGroup
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getGroups(): GenericCollection
    {
        return $this->groups;
    }

    /**
     * @param GenericCollection $groups
     * @return EpisodeGroup
     */
    public function setGroups(GenericCollection $groups): EpisodeGroup
    {
        $this->groups = $groups;

        return $this;
    }
}
