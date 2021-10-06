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

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Network;

/**
 * Class TvEpisodeGroup
 * @package Tmdb\Model\Tv
 */
class TvEpisodeGroup extends AbstractModel
{
    /**
     * Properties that are available in the API
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
    private $order;
    /**
     * @var boolean
     */
    private $locked;

    /**
     * @var GenericCollection
     */
    protected $episodes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->episodes = new GenericCollection();
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
     * @return TvEpisodeGroup
     */
    public function setId(string $id): TvEpisodeGroup
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
     * @return TvEpisodeGroup
     */
    public function setName(string $name): TvEpisodeGroup
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
     * @return TvEpisodeGroup
     */
    public function setNetwork(?Network $network): TvEpisodeGroup
    {
        $this->network = $network;

        return $this;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     * @return TvEpisodeGroup
     */
    public function setLocked(bool $locked): TvEpisodeGroup
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getEpisodes(): GenericCollection
    {
        return $this->episodes;
    }

    /**
     * @param GenericCollection $episodes
     * @return TvEpisodeGroup
     */
    public function setEpisodes(GenericCollection $episodes): TvEpisodeGroup
    {
        $this->episodes = $episodes;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return TvEpisodeGroup
     */
    public function setOrder(int $order): TvEpisodeGroup
    {
        $this->order = $order;

        return $this;
    }
}
