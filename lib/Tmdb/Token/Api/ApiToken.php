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

namespace Tmdb\Token\Api;

use Tmdb\Exception\RuntimeException;

/**
 * Class ApiToken
 * @package Tmdb
 */
class ApiToken
{
    private $apiToken = null;

    /**
     * Token bag
     *
     * @param $api_token
     */
    public function __construct($api_token = null)
    {
        $this->apiToken = $api_token;
    }

    /**
     * @param string $apiToken
     * @return $this
     * @throws RuntimeException
     */
    public function setToken($apiToken)
    {
        if (!is_string($apiToken)) {
            throw new RuntimeException('The Apitoken must be set.');
        }

        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->apiToken;
    }

    public function __toString()
    {
        return (string)$this->apiToken;
    }
}
