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

namespace Tmdb\Token\Session;

use DateTime;

/**
 * Class RequestToken.
 */
class RequestToken implements \Stringable
{
    /**
     * Expiry date UTC.
     */
    private ?\DateTime $expiresAt = null;

    private ?bool $success = null;

    /**
     * Token bag.
     *
     * @param string|null $token
     */
    public function __construct(
        /**
         * The token for obtaining a session.
         */
        private $token = null
    )
    {
    }

    /**
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }

    public function setToken(?string $token = null): static
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param DateTime|string $expiresAt
     */
    public function setExpiresAt($expiresAt): static
    {
        if (!$expiresAt instanceof DateTime) {
            $expiresAt = new DateTime($expiresAt);
        }

        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSuccess()
    {
        return $this->success;
    }

    public function setSuccess(bool $success): static
    {
        $this->success = $success;

        return $this;
    }

    #[\Override]
    public function __toString(): string
    {
        return (string) $this->token;
    }
}
