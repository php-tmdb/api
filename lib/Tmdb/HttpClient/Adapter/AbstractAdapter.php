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
namespace Tmdb\HttpClient\Adapter;

/**
 * Interface AdapterInterface
 * @package Tmdb\HttpClient
 */
abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * @{@inheritdoc}
     */
    public function postJson($path, $postBody, array $parameters = [], array $headers = [])
    {
        return $this->post(
            $path,
            is_array($postBody) ? json_encode($postBody) : $postBody,
            $parameters,
            $headers
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setQueryParameters(array $queryParameters = [])
    {
        foreach ($queryParameters as $key => $value) {
            $this->setQueryParameter($key, $value);
        }
    }
}
