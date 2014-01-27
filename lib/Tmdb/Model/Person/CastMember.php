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
 * @version 0.0.1
 */
namespace Tmdb\Model\Person;

use Tmdb\Model\Collection\People\PersonInterface;

class CastMember extends AbstractMember implements PersonInterface {

    private $character;
    private $order;
    private $castId;

    public static $_properties = array(
        'id',
        'cast_id',
        'name',
        'character',
        'order',
        'profile_path'
    );

    /**
     * @param mixed $character
     * @return $this
     */
    public function setCharacter($character)
    {
        $this->character = $character;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param mixed $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = (int) $order;
        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $castId
     * @return $this
     */
    public function setCastId($castId)
    {
        $this->castId = $castId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCastId()
    {
        return $this->castId;
    }
}
