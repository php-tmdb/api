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
 * Class TvEpisodeGroup.
 */
class TvEpisodeGroup extends AbstractModel
{
    /**
     * Properties that are available in the API.
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'id',
        'name',
        'order',
        'locked',
    ];

    private ?string $id = null;
    private ?string $name = null;
    private ?\Tmdb\Model\Network $network = null;
    private ?int $order = null;
    private ?bool $locked = null;

    /**
     * @var GenericCollection
     */
    protected $episodes;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->episodes = new GenericCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): TvEpisodeGroup
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TvEpisodeGroup
    {
        $this->name = $name;

        return $this;
    }

    public function getNetwork(): ?Network
    {
        return $this->network;
    }

    public function setNetwork(?Network $network): TvEpisodeGroup
    {
        $this->network = $network;

        return $this;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): TvEpisodeGroup
    {
        $this->locked = $locked;

        return $this;
    }

    public function getEpisodes(): GenericCollection
    {
        return $this->episodes;
    }

    public function setEpisodes(GenericCollection $episodes): TvEpisodeGroup
    {
        $this->episodes = $episodes;

        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): TvEpisodeGroup
    {
        $this->order = $order;

        return $this;
    }
}
