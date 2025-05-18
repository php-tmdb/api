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

namespace Tmdb\Model\Collection;

use Tmdb\Model\Collection\People\Cast;
use Tmdb\Model\Collection\People\Crew;
use Tmdb\Model\Collection\People\GuestStars;

/**
 * Class CreditsCollection.
 */
class CreditsCollection
{
    /**
     * @var Cast
     */
    public $cast;

    private \Tmdb\Model\Collection\People\Crew $crew;

    private \Tmdb\Model\Collection\People\GuestStars $guestStars;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cast = new Cast();
        $this->crew = new Crew();
        $this->guestStars = new GuestStars();
    }

    /**
     * @return Cast
     */
    public function getCast()
    {
        return $this->cast;
    }

    public function setCast(Cast $cast): static
    {
        $this->cast = $cast;

        return $this;
    }

    /**
     * @return Crew
     */
    public function getCrew()
    {
        return $this->crew;
    }

    public function setCrew(Crew $crew): static
    {
        $this->crew = $crew;

        return $this;
    }

    /**
     * @return GuestStars
     */
    public function getGuestStars()
    {
        return $this->guestStars;
    }

    /**
     * @param GuestStars $guestStars
     */
    public function setGuestStars($guestStars): void
    {
        $this->guestStars = $guestStars;
    }
}
