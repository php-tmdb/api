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
namespace Tmdb\Model\Changes;

use Tmdb\Client;
use Tmdb\Model\AbstractModel;

class Change extends AbstractModel {

    private $id;
    private $adult = false;

    protected static $_properties = array(
        'id',
        'adult',
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
        $genre = new Change($data['id']);
        //$genre->setClient($client);

        return $genre->hydrate($data);
    }

    /**
     * @param boolean $adult
     * @return $this
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}