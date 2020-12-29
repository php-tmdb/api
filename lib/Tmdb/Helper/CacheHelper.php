<?php

namespace Tmdb\Helper;

use Psr\Http\Message\RequestInterface;

class CacheHelper
{
    /**
     * @param RequestInterface $request
     * @return string
     */
    public function getUniqueIdentifier(RequestInterface $request): string
    {
    }
}
