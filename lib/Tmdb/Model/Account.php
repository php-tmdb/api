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

namespace Tmdb\Model;

use Tmdb\Model\Common\GenericCollection;

/**
 * Class Account
 * @package Tmdb\Model
 */
class Account extends AbstractModel
{
    /**
     * @var array
     */
    public static $properties = [
        'id',
        'include_adult',
        'iso_3166_1',
        'iso_639_1',
        'name',
        'username'
    ];
    /**
     * @var integer
     */
    private $id;
    /**
     * @var boolean
     */
    private $includeAdult;
    /**
     * @var string
     */
    private $iso31661;
    /**
     * @var string
     */
    private $iso6391;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $username;
    /**
     * @var GenericCollection
     */
    private $avatar;

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
     * @return boolean
     */
    public function getIncludeAdult()
    {
        return $this->includeAdult;
    }

    /**
     * @param boolean $includeAdult
     * @return self
     */
    public function setIncludeAdult($includeAdult)
    {
        $this->includeAdult = $includeAdult;

        return $this;
    }

    /**
     * @return string
     */
    public function getIso31661()
    {
        return $this->iso31661;
    }

    /**
     * @param string $iso31661
     * @return self
     */
    public function setIso31661($iso31661)
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    /**
     * @return string
     */
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param string $iso6391
     * @return self
     */
    public function setIso6391($iso6391)
    {
        $this->iso6391 = $iso6391;

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
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param GenericCollection $avatar
     * @return self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
}
