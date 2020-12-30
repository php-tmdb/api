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

namespace Tmdb\Exception\Factory;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Exception\RuntimeException;
use Tmdb\Exception\TmdbApiException;
use Tmdb\Exception\UnexpectedResponseException;

class ResponseExceptionFactory
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return TmdbApiException
     * @throws UnexpectedResponseException
     * @throws RuntimeException
     */
    public function createTmdbApiException(RequestInterface $request, ResponseInterface $response): TmdbApiException
    {
        try {
            if (
                $response->hasHeader('content-type') &&
                strpos($response->getHeaderLine('content-type'), 'application/json')  !== false
            ) {
                $response->getBody()->rewind();

                $body = $response->getBody()->getContents();
                $data = json_decode($body, false, 512, JSON_THROW_ON_ERROR);

                return new TmdbApiException(
                    $data->status_code,
                    $data->status_message,
                    $request,
                    $response
                );
            }
        } catch (\Exception $e) {
            throw new RuntimeException('Unable to create TmdbApiException, could not decode response body.');
        }

        throw new UnexpectedResponseException(
            'Unable to create an helpful Exception, server did not contain a json body.'
        );
    }
}
