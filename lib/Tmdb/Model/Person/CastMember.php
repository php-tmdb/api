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

namespace Tmdb\Model\Person;

use Tmdb\Model\Collection\People\PersonInterface;

/**
 * Class CastMember.
 */
class CastMember extends AbstractMember implements PersonInterface
{
    public static $properties = [
        'id',
        'credit_id',
        'cast_id',
        'name',
        'character',
        'order',
        'profile_path',
    ];
    /**
     * @var string
     */
    private $character;
    private ?int $order = null;
    private ?int $castId = null;
    private $creditId;

    /**
     * @return string
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param string $character
     */
    public function setCharacter($character): static
    {
        $this->character = $character;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order): static
    {
        $this->order = (int) $order;

        return $this;
    }

    /**
     * @return int
     */
    public function getCastId()
    {
        return $this->castId;
    }

    public function setCastId($castId): static
    {
        $this->castId = (int) $castId;

        return $this;
    }

    public function getCreditId()
    {
        return $this->creditId;
    }

    public function setCreditId($creditId): static
    {
        $this->creditId = $creditId;

        return $this;
    }
}
