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

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;

/**
 * Class AccountStates
 * @package Tmdb\Model\Common
 */
class AccountStates extends AbstractModel
{
    public static $properties = [
        'id',
        'favorite',
        'watchlist',
    ];
    /**
     * @var integer
     */
    private $id;
    /**
     * @var boolean
     */
    private $favorite;
    /**
     * @var Rating|boolean
     */
    private $rated;
    /**
     * @var boolean
     */
    private $watchlist;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rated = new Rating();
    }

    /**
     * @return boolean
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * @param boolean $favorite
     * @return self
     */
    public function setFavorite($favorite)
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
     * @return self
     */
    public function setId($id)
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
     * @return self
     */
    public function setRated($rated)
    {
        $this->rated = $rated;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getWatchlist()
    {
        return $this->watchlist;
    }

    /**
     * @param boolean $watchlist
     * @return self
     */
    public function setWatchlist($watchlist)
    {
        $this->watchlist = $watchlist;

        return $this;
    }
}
