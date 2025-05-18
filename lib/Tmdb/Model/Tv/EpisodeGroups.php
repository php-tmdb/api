<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author sheriffmarley
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Model\Tv;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Network;

/**
 * Class EpisodeGroups.
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
     * Properties that are available in the API.
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

    private ?string $description = null;
    private ?int $episodeCount = null;
    private ?int $groupCount = null;
    private ?string $id = null;
    private ?string $name = null;
    private ?\Tmdb\Model\Network $network = null;
    private ?int $type = null;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): EpisodeGroups
    {
        $this->description = $description;

        return $this;
    }

    public function getEpisodeCount(): int
    {
        return $this->episodeCount;
    }

    public function setEpisodeCount(int $episodeCount): EpisodeGroups
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    public function getGroupCount(): int
    {
        return $this->groupCount;
    }

    public function setGroupCount(int $groupCount): EpisodeGroups
    {
        $this->groupCount = $groupCount;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): EpisodeGroups
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EpisodeGroups
    {
        $this->name = $name;

        return $this;
    }

    public function getNetwork(): ?Network
    {
        return $this->network;
    }

    public function setNetwork(?Network $network): EpisodeGroups
    {
        $this->network = $network;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): EpisodeGroups
    {
        $this->type = $type;

        return $this;
    }
}
