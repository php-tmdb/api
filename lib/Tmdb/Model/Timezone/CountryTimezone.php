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

namespace Tmdb\Model\Timezone;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\Timezones;

/**
 * Class Timezone.
 */
class CountryTimezone extends AbstractModel implements \Stringable
{
    /**
     * @var string
     */
    private $iso31661;

    private \Tmdb\Model\Collection\Timezones $timezones;

    public function __construct()
    {
        $this->timezones = new Timezones();
    }

    /**
     * @return Timezones
     */
    public function getTimezones()
    {
        return $this->timezones;
    }

    /**
     * @param Timezones $timezones
     */
    public function setTimezones($timezones): static
    {
        $this->timezones = $timezones;

        return $this;
    }

    /**
     * @return string
     */
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
     * Verify if a country supports a certain timezone.
     */
    public function supports($timezone): bool
    {
        return false !== $this->timezones->hasValue($timezone);
    }

    #[\Override]
    public function __toString(): string
    {
        return $this->iso31661;
    }
}
