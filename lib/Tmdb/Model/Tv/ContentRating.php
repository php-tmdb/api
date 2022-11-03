<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Ernest Wagner <wagnered@comcast.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\Model\Tv;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Filter\CountryFilter;

/**
 * Class ContentRating
 * @package Tmdb\Model\Tv
 */
class ContentRating extends AbstractModel implements CountryFilter
{
    /**
     * Properties that are available in the API
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'iso_3166_1',
        'rating',
    ];
    /**
     * @var string
     */
    private $iso_3166_1;
    /**
     * @var string
     */
    private $rating;

    /**
     * @return string
     */
    public function getIso31661()
    {
        return $this->iso_3166_1;
    }

    /**
     * @param string $country
     * @return self
     */
    public function setIso31661($country)
    {
        $this->iso_3166_1 = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     * @return self
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }
}
