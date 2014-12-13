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
     * @param string       $path       Request path
     * @param ParameterBag $parameters Parameters for the request
     *
     * @return mixed Data
     */
    public function get($path, ParameterBag $parameters);

    /**
     * Send a HEAD request
     *
     * @param $path
     * @param  ParameterBag $parameters
     * @return mixed
     */
    public function head($path, ParameterBag $parameters);

    /**
     * Compose a POST request
     *
     * @param string       $path       Request path
     * @param string       $body       The post BODY
     * @param ParameterBag $parameters POST Parameters
     *
     * @return mixed Data
     */
    public function post($path, $body = null, ParameterBag $parameters);

    /**
     * Send a PUT request
     *
     * @param $path
     * @param  null         $body
     * @param  ParameterBag $parameters
     * @return mixed
     */
    public function put($path, $body = null, ParameterBag $parameters);

    /**
     * Send a DELETE request
     *
     * @param  string       $path
     * @param  null         $body
     * @param  ParameterBag $parameters
     * @return mixed
     */
    public function delete($path, $body = null, ParameterBag $parameters);

    /**
     * Send a PATCH request
     *
     * @param $path
     * @param  null         $body
     * @param  ParameterBag $parameters
     * @return mixed
     */
    public function patch($path, $body = null, ParameterBag $parameters);

    /**
     * Return the used client
     *
     * @return mixed
     */
    public function getClient();
}
