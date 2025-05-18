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
 * Class SessionToken.
 */
class SessionToken implements \Stringable
{
    private ?\DateTime $expiresAt = null;

    /**
     * @var bool
     */
    private $success;

    /**
     * Token bag.
     */
    public function __construct(private ?string $sessionToken = null)
    {
    }

    
    public function setToken($sessionToken): static
    {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->sessionToken;
    }

    /**
     * @return ?DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param string|DateTime $expiresAt
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

    /**
     * @param bool $success
     */
    public function setSuccess($success): static
    {
        $this->success = $success;

        return $this;
    }

    #[\Override]
    public function __toString(): string
    {
        return (string) $this->sessionToken;
    }
}
