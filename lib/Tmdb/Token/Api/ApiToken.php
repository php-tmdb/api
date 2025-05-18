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

namespace Tmdb\Token\Api;

use Tmdb\Exception\RuntimeException;

/**
 * Class ApiToken.
 */
class ApiToken implements \Stringable
{
    /**
     * Token bag.
     */
    public function __construct(private $apiToken = null)
    {
    }

    /**
     * @throws RuntimeException
     */
    public function setToken(string $apiToken): static
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->apiToken;
    }

    #[\Override]
    public function __toString(): string
    {
        return (string) $this->apiToken;
    }
}
