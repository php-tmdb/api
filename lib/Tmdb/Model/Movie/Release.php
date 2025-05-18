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

namespace Tmdb\Model\Movie;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Filter\CountryFilter;

/**
 * Class Release.
 *
 * @deprecated Use ReleaseDate instead
 */
class Release extends AbstractModel implements CountryFilter
{
    public static $properties = [
        'iso_3166_1',
        'certification',
        'primary',
        'release_date',
    ];
    private $iso31661;
    private $certification;
    private $primary;
    private ?\DateTime $releaseDate = null;

    public function getCertification()
    {
        return $this->certification;
    }

    public function setCertification($certification): static
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * @return string
     */
    #[\Override]
    public function getIso31661()
    {
        return $this->iso31661;
    }

    /**
     * @param string $iso31661
     */
    public function setIso31661($iso31661): static
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param string|DateTime|null $releaseDate
     */
    public function setReleaseDate($releaseDate = null): static
    {
        if (!$releaseDate instanceof DateTime && null !== $releaseDate) {
            $releaseDate = new DateTime($releaseDate);
        }

        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPrimary()
    {
        return $this->primary;
    }

    public function setPrimary($primary): static
    {
        $this->primary = $primary;

        return $this;
    }
}
