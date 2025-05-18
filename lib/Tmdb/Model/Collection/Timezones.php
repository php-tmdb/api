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

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Timezone\CountryTimezone;

/**
 * Class Timezones.
 */
class Timezones extends GenericCollection
{
    /**
     * Returns all countries with timezones.
     *
     * @return array
     */
    public function getCountries()
    {
        return $this->data;
    }

    /**
     * Retrieve a country from the collection.
     *
     * @return CountryTimezone|null
     */
    public function getCountry($id)
    {
        foreach ($this->data as $country) {
            if (strtoupper((string) $id) === (string) $country) {
                return $country;
            }
        }

        return null;
    }

    /**
     * Add a timezone to the collection.
     *
     * @param CountryTimezone $country
     */
    public function addCountry($country): void
    {
        $this->data[] = $country;
    }
}
