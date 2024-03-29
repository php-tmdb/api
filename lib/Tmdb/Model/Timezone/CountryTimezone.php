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

namespace Tmdb\Model\Timezone;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\Timezones;

/**
 * Class Timezone
 * @package Tmdb\Model\Certification
 */
class CountryTimezone extends AbstractModel
{
    /**
     * @var string
     */
    private $iso31661;

    /**
     * @var Timezones
     */
    private $timezones;

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
     * @return self
     */
    public function setTimezones($timezones)
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
     * @return self
     */
    public function setIso31661($iso31661)
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    /**
     * Verify if a country supports a certain timezone
     *
     * @param $timezone
     * @return boolean
     */
    public function supports($timezone)
    {
        return false !== $this->timezones->hasValue($timezone);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->iso31661;
    }
}
