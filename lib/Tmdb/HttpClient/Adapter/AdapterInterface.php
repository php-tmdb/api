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
use Tmdb\Common\ParameterBag;

/**
 * Interface AdapterInterface
 * @package Tmdb\HttpClient
 */
interface AdapterInterface
{
    /**
     * Compose a GET request
     *
     * @param string $path       Request path
     * @param array  $parameters GET Parameters
     * @param array  $headers    Reconfigure the request headers for this call only
     *
     * @return Response Data
     */
    public function get($path, ParameterBag $parameters);

    /**
     * Compose a POST request
     *
     * @param string $path       Request path
     * @param string $postBody   The post BODY
     * @param array  $parameters POST Parameters
     * @param array  $headers    Reconfigure the request headers for this call only
     *
     * @return Response Data
     */
    public function post($path, $postBody, array $parameters = [], array $headers = []);

    /**
     * Compose a POST request but json_encode the body
     *
     * @param string      $path       Request path
     * @param string|null $postBody   The post BODY
     * @param array       $parameters POST Parameters
     * @param array       $headers    Reconfigure the request headers for this call only
     *
     * @return Response Data
     */
    public function postJson($path, $postBody, array $parameters = [], array $headers = []);

}
