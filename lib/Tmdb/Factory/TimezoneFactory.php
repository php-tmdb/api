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

use Tmdb\Model\Collection\Timezones;
use Tmdb\Model\Timezone;

/**
 * Class TimezoneFactory.
 */
class TimezoneFactory extends AbstractFactory
{
    #[\Override]
    public function create(array $data = []): Timezone\CountryTimezone
    {
        return $this->hydrate(new Timezone\CountryTimezone(), $data);
    }

    #[\Override]
    public function createCollection(array $data = []): Timezones
    {
        $collection = new Timezones();

        foreach ($data as $foobar_data) {
            foreach ($foobar_data as $iso_3166_1 => $timezones) {
                $country = new Timezone\CountryTimezone();
                $country->setIso31661($iso_3166_1);

                foreach ($timezones as $timezone) {
                    $country->getTimezones()->add(null, $timezone);
                }

                $collection->add(null, $country);
            }
        }

        return $collection;
    }
}
