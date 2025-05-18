<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Factory;

use DateTime;
use RuntimeException;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\RequestToken;
use Tmdb\Token\Session\SessionToken;

/**
 * Class AuthenticationFactory.
 */
class AuthenticationFactory extends AbstractFactory
{
    /**
     * @throws RuntimeException
     */
    #[\Override]
    public function create(array $data = []): never
    {
        throw new RuntimeException(\sprintf('Class "%s" does not support method "%s".', self::class, __METHOD__));
    }

    /**
     * @throws RuntimeException
     */
    #[\Override]
    public function createCollection(array $data = []): never
    {
        throw new RuntimeException(\sprintf('Class "%s" does not support method "%s".', self::class, __METHOD__));
    }

    /**
     * Create request token.
     */
    public function createRequestToken(array $data = []): \Tmdb\Token\Session\RequestToken
    {
        $token = new RequestToken();

        if (\array_key_exists('expires_at', $data)) {
            $token->setExpiresAt(new DateTime($data['expires_at']));
        }

        if (\array_key_exists('request_token', $data)) {
            $token->setToken($data['request_token']);
        }

        if (\array_key_exists('success', $data)) {
            $token->setSuccess($data['success']);
        }

        return $token;
    }

    /**
     * Create session token for user.
     */
    public function createSessionToken(array $data = []): \Tmdb\Token\Session\SessionToken
    {
        $token = new SessionToken();

        if (\array_key_exists('session_id', $data)) {
            $token->setToken($data['session_id']);
        }

        if (\array_key_exists('success', $data)) {
            $token->setSuccess($data['success']);
        }

        return $token;
    }

    /**
     * Create session token for guest.
     */
    public function createGuestSessionToken(array $data = []): \Tmdb\Token\Session\GuestSessionToken
    {
        $token = new GuestSessionToken();

        if (\array_key_exists('expires_at', $data)) {
            $token->setExpiresAt(new DateTime($data['expires_at']));
        }

        if (\array_key_exists('guest_session_id', $data)) {
            $token->setToken($data['guest_session_id']);
        }

        if (\array_key_exists('success', $data)) {
            $token->setSuccess($data['success']);
        }

        return $token;
    }
}
