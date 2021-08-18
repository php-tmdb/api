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

namespace Tmdb\Helper;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestQueryHelper
{
    /**
     * @param RequestInterface $request
     * @param $key
     * @param $value
     * @return RequestInterface
     */
    public function withQuery(RequestInterface $request, $key, $value): RequestInterface
    {
        $uri = $this->addQueryToUri($request->getUri(), $key, $value);

        return $request->withUri($uri);
    }

    /**
     * @param UriInterface $uri
     * @param $key
     * @param $value
     * @return UriInterface
     */
    private function addQueryToUri(UriInterface $uri, $key, $value): UriInterface
    {
        $parameters = [];
        foreach (explode('&', $uri->getQuery()) as $curParam) {
            if ($curParam && ($curParamParts = explode('=', $curParam))) {
                $parameters[urldecode($curParamParts[0])] = urldecode($curParamParts[1] ?? null);
            }
        }
        $parameters[$key] = $value;

        ksort($parameters);

        return $uri->withQuery(http_build_query($parameters));
    }
}
