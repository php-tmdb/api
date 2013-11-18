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

use Tmdb\Client;
use Tmdb\Model\Collection\People\PersonInterface;

class CastMember extends AbstractMember implements PersonInterface {

    private $character;
    private $order;

    public static $_properties = array(
        'id',
        'name',
        'character',
        'order',
        'profile_path'
    );

    /**
     * Convert an array to an hydrated object
     *
     * @param Client $client
     * @param array $data
     * @return $this
     */
    public static function fromArray(Client $client, array $data)
    {
        $castMember = new CastMember();
        //$castMember->setClient($client);

        return $castMember->hydrate($data);
    }

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
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }


}