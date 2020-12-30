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

namespace Tmdb\Factory;

use DateTime;
use RuntimeException;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\RequestToken;
use Tmdb\Token\Session\SessionToken;

/**
 * Class AuthenticationFactory
 * @package Tmdb\Factory
 */
class AuthenticationFactory extends AbstractFactory
{
    /**
     * @param array $data
     *
     * @return void
     * @throws RuntimeException
     */
    public function create(array $data = [])
    {
        throw new RuntimeException(sprintf(
            'Class "%s" does not support method "%s".',
            __CLASS__,
            __METHOD__
        ));
    }

    /**
     * @param array $data
     *
     * @return void
     * @throws RuntimeException
     */
    public function createCollection(array $data = [])
    {
        throw new RuntimeException(sprintf(
            'Class "%s" does not support method "%s".',
            __CLASS__,
            __METHOD__
        ));
    }

    /**
     * Create request token
     *
     * @param array $data
     * @return RequestToken
     */
    public function createRequestToken(array $data = [])
    {
        $token = new RequestToken();

        if (array_key_exists('expires_at', $data)) {
            $token->setExpiresAt(new DateTime($data['expires_at']));
        }

        if (array_key_exists('request_token', $data)) {
            $token->setToken($data['request_token']);
        }

        if (array_key_exists('success', $data)) {
            $token->setSuccess($data['success']);
        }

        return $token;
    }

    /**
     * Create session token for user
     *
     * @param array $data
     * @return SessionToken
     */
    public function createSessionToken(array $data = [])
    {
        $token = new SessionToken();

        if (array_key_exists('session_id', $data)) {
            $token->setToken($data['session_id']);
        }

        if (array_key_exists('success', $data)) {
            $token->setSuccess($data['success']);
        }

        return $token;
    }

    /**
     * Create session token for guest
     *
     * @param array $data
     * @return SessionToken
     */
    public function createGuestSessionToken(array $data = [])
    {
        $token = new GuestSessionToken();

        if (array_key_exists('expires_at', $data)) {
            $token->setExpiresAt(new DateTime($data['expires_at']));
        }

        if (array_key_exists('guest_session_id', $data)) {
            $token->setToken($data['guest_session_id']);
        }

        if (array_key_exists('success', $data)) {
            $token->setSuccess($data['success']);
        }

        return $token;
    }
}
