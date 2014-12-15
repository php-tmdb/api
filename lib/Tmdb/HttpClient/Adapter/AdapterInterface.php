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
use Tmdb\HttpClient\Request;

/**
 * Interface AdapterInterface
 * @package Tmdb\HttpClient
 */
interface AdapterInterface
{
    /**
     * Compose a GET request
     *
     * @param Request $request
     *
     * @return mixed Data
     */
    public function get(Request $request);

    /**
     * Send a HEAD request
     *
     * @param  Request $request
     * @return mixed
     */
    public function head(Request $request);

    /**
     * Compose a POST request
     *
     * @param  Request $request
     * @return mixed   Data
     */
    public function post(Request $request);

    /**
     * Send a PUT request
     *
     * @param  Request $request
     * @return mixed
     */
    public function put(Request $request);

    /**
     * Send a DELETE request
     *
     * @param  Request $request
     * @return mixed
     */
    public function delete(Request $request);

    /**
     * Send a PATCH request
     *
     * @param  Request $request
     * @return mixed
     */
    public function patch(Request $request);

    /**
     * Return the used client
     *
     * @return mixed
     */
    public function getClient();
}
