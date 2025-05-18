<?php

declare(strict_types=1);

namespace Tmdb\Formatter\TmdbApiException;

use Tmdb\Exception\TmdbApiException;
use Tmdb\Formatter\TmdbApiExceptionFormatterInterface;

class SimpleTmdbApiExceptionFormatter implements TmdbApiExceptionFormatterInterface
{
    #[\Override]
    public function formatApiException(TmdbApiException $exception): string
    {
        return \sprintf(
            '%s %s',
            $exception->getCode(),
            $exception->getMessage(),
        );
    }
}
