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

namespace Tmdb\Model\Credits;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class Media
 * @package Tmdb\Model\Credits
 */
class Media extends AbstractModel
{
    public static $properties = [
        'id',
        'name',
        'original_name',
        'character',
    ];
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $originalName;
    /**
     * @var string
     */
    private $character;
    /**
     * @var GenericCollection
     */
    private $episodes;
    /**
     * @var GenericCollection
     */
    private $seasons;

    /**
     * @return string
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param string $character
     * @return self
     */
    public function setCharacter($character)
    {
        $this->character = $character;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * @param GenericCollection $episodes
     * @return self
     */
    public function setEpisodes($episodes)
    {
        $this->episodes = $episodes;

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
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     * @return self
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * @param GenericCollection $seasons
     * @return self
     */
    public function setSeasons($seasons)
    {
        $this->seasons = $seasons;

        return $this;
    }
}
