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
namespace Tmdb\HttpClient\Plugin;

use Guzzle\Http\Exception\HttpException;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Backoff\AbstractErrorCodeBackoffStrategy;

/**
 * Class BackoffRetryAfterPlugin
 *
 * Provides an implementation of http://tools.ietf.org/html/rfc6585#section-4 to solve ticket #356
 *
 * @package Tmdb\HttpClient\Plugin
 */
class BackoffRetryAfterPlugin extends AbstractErrorCodeBackoffStrategy
{
    /**
     * {@inheritdoc}
     */
    protected function getDelay($retries, RequestInterface $request, Response $response = null, HttpException $e = null)
    {
        if ($response) {
            if ($response->isSuccessful()) {
                return false;
            } else {
                if ($response->getStatusCode() == 429) {
                    return $response->getRetryAfter();
                }

                return null;
            }
        }
    }
}
