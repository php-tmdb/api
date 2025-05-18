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

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;

/**
 * Class AccountStates.
 */
class AccountStates extends AbstractModel
{
    public static $properties = [
        'id',
        'favorite',
        'watchlist',
    ];
    /**
     * @var int
     */
    private $id;
    /**
     * @var bool
     */
    private $favorite;
    /**
     * @var Rating|bool
     */
    private \Tmdb\Model\Common\Rating $rated;
    /**
     * @var bool
     */
    private $watchlist;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->rated = new Rating();
    }

    /**
     * @return bool
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * @param bool $favorite
     */
    public function setFavorite($favorite): static
    {
        $this->favorite = $favorite;

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
        $this->id = $id;

        return $this;
    }

    /**
     * @return Rating|bool
     */
    public function getRated()
    {
        return $this->rated;
    }

    /**
     * @param Rating|bool $rated
     */
    public function setRated($rated): static
    {
        $this->rated = $rated;

        return $this;
    }

    /**
     * @return bool
     */
    public function getWatchlist()
    {
        return $this->watchlist;
    }

    /**
     * @param bool $watchlist
     */
    public function setWatchlist($watchlist): static
    {
        $this->watchlist = $watchlist;

        return $this;
    }
}
