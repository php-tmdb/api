<?php


namespace Tmdb\Helper;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestQueryHelper
{
    public function

    public function addQueryToUri(UriInterface $uri, $key, $value)
    {
        $parameters = parse_str($uri->getQuery());
        $parameters[$key] = $value;
        $uri = $uri->withQuery(http_build_query($parameters));

        return $uri;
    }
}
