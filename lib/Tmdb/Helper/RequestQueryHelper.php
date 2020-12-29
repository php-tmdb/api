<?php

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
        parse_str($uri->getQuery(), $parameters);
        $parameters[$key] = $value;

        ksort($parameters);

        return $uri->withQuery(http_build_query($parameters));
    }
}
