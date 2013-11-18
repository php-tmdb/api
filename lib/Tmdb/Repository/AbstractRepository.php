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
namespace Tmdb\Repository;

use Tmdb\Client;
use Tmdb\Model\Common\QueryParameter\QueryParameterInterface;

abstract class AbstractRepository {

    private static $client = null;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        self::$client = $client;
    }

    /**
     * Return the client
     *
     * @return Client
     */
    public function getClient()
    {
        return self::$client;
    }

    /**
     * Process query parameters
     *
     * @param array $parameters
     * @return array
     */
    protected function parseQueryParameters(array $parameters = array())
    {
        foreach($parameters as $key => $candidate) {
            if ($candidate instanceof QueryParameterInterface) {
                unset($parameters[$key]);

                $parameters[$candidate->getKey()] = $candidate->getValue();
            }
        }

        return $parameters;
    }
} 