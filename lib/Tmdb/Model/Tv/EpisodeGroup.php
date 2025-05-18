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
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Network;

/**
 * Class Season.
 */
class EpisodeGroup extends AbstractModel
{
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

    /**
     * @var GenericCollection
     */
    protected $groups;

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

    public function setDescription(string $description): EpisodeGroup
    {
        $this->description = $description;

        return $this;
    }

    public function getEpisodeCount(): int
    {
        return $this->episodeCount;
    }

    public function setEpisodeCount(int $episodeCount): EpisodeGroup
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    public function getGroupCount(): int
    {
        return $this->groupCount;
    }

    public function setGroupCount(int $groupCount): EpisodeGroup
    {
        $this->groupCount = $groupCount;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): EpisodeGroup
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EpisodeGroup
    {
        $this->name = $name;

        return $this;
    }

    public function getNetwork(): ?Network
    {
        return $this->network;
    }

    public function setNetwork(?Network $network): EpisodeGroup
    {
        $this->network = $network;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): EpisodeGroup
    {
        $this->type = $type;

        return $this;
    }

    public function getGroups(): GenericCollection
    {
        return $this->groups;
    }

    public function setGroups(GenericCollection $groups): EpisodeGroup
    {
        $this->groups = $groups;

        return $this;
    }
}
