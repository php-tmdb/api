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

namespace Tmdb\Model\Watch;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Filter\CountryFilter;

/**
 * Class Watch Providers
 * @package Tmdb\Model\Watch
 */
class Providers extends AbstractModel implements CountryFilter
{
    public static $properties = [
        'iso_3166_1',
        'link',
        'flatrate',
        'rent',
        'buy'
    ];
    private $iso31661;
    private $link;
    private $flatrate;
    private $rent;
    private $buy;
    
    /**
     * Constructor
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->flatrate = new GenericCollection();
        $this->rent = new GenericCollection();
        $this->buy = new GenericCollection();
    }

    /**
     * @return string|null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;

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
     * @return $this
     */
    public function setIso31661($iso31661)
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getFlatrate()
    {
        return $this->flatrate;
    }

    /**
     * @param GenericCollection $flatrate
     * @return $this
     */
    public function setFlatrate($flatrate)
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getRent()
    {
        return $this->rent;
    }

    /**
     * @param GenericCollection $rent
     * @return $this
     */
    public function setRent($rent)
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getBuy()
    {
        return $this->buy;
    }

    /**
     * @param GenericCollection $buy
     * @return $this
     */
    public function setBuy($buy)
    {
        $this->buy = $buy;

        return $this;
    }
}
