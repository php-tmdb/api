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
namespace Tmdb\Model;

use Tmdb\Client;

class AbstractModel {
    public static $_properties;

    protected $_data = array();
    protected $_client = null;

    /**
     * Retrieve the client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Set the client
     *
     * @param Client $client
     * @return $this
     */
    public function setClient(Client $client = null)
    {
        if (null !== $client) {
            $this->_client = $client;
        }

        return $this;
    }

    /**
     * Call a part of the API
     *
     * @param $api
     * @return mixed
     */
    public function api($api)
    {
        return $this->getClient()->api($api);
    }

}