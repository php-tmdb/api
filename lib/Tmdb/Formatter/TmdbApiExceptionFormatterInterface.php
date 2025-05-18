<?php

declare(strict_types=1);

namespace Tmdb\Formatter;

use Tmdb\Exception\TmdbApiException;

interface TmdbApiExceptionFormatterInterface
{
    public function formatApiException(TmdbApiException $exception): string;
}
