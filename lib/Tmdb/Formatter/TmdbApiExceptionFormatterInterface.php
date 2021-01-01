<?php

namespace Tmdb\Formatter;

use Tmdb\Exception\TmdbApiException;

interface TmdbApiExceptionFormatterInterface
{
    /**
     * @param TmdbApiException $exception
     * @return string
     */
    public function formatApiException(TmdbApiException $exception): string;
}
