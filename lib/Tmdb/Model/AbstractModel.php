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
use Tmdb\Exception\RuntimeException;

class AbstractModel {
    protected static $_properties;

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

    /**
     * Hydrate the object with data
     *
     * @param array $data
     * @return $this
     * @throws \Tmdb\Exception\RuntimeException
     */
    public function hydrate(array $data = array())
    {
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (in_array($k, static::$_properties)) {
                    $method = sprintf('set%s', ucfirst($k));

                    if (!method_exists($this, $method)) {
                        throw new RuntimeException(sprintf(
                            'Trying to call method "%s" on "%s" but it does not exist or is private.',
                            $method,
                            get_class($this)
                        ));
                    }

                    $this->$method($v);
                }
            }
        }

        return $this;
    }
}