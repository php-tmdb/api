<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Repository;

use Psr\EventDispatcher\EventDispatcherInterface;
use Tmdb\Api\ApiInterface;
use Tmdb\Client;
use Tmdb\Factory\AbstractFactory;

/**
 * Class AbstractRepository.
 */
abstract class AbstractRepository
{
    protected $api;

    /**
     * Constructor.
     */
    public function __construct(protected \Tmdb\Client $client)
    {
    }

    /**
     * Return the client.
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->client->getEventDispatcher();
    }

    /**
     * Return the API Class.
     *
     * @return ApiInterface
     */
    abstract public function getApi();

    /**
     * Return the Factory Class.
     *
     * @return AbstractFactory
     */
    abstract public function getFactory();

    /**
     * Process query parameters.
     *
     * @return array
     */
    protected function parseQueryParameters(array $parameters = [])
    {
        foreach ($parameters as $key => $candidate) {
            if (is_a($candidate, 'Tmdb\Model\Common\QueryParameter\QueryParameterInterface')) {
                $interfaces = class_implements($candidate);

                if (\array_key_exists(\Tmdb\Model\Common\QueryParameter\QueryParameterInterface::class, $interfaces)) {
                    unset($parameters[$key]);

                    $parameters[$candidate->getKey()] = $candidate->getValue();
                }
            }
        }

        return $parameters;
    }
}
