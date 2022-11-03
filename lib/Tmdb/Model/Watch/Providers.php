<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Neil Daniels <neil.here@gmail.com>
 * @copyright (c) 2021, Neil Daniels
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
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return self
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIso31661(): ?string
    {
        return $this->iso31661;
    }

    /**
     * @param string $iso31661
     * @return self
     */
    public function setIso31661(?string $iso31661): self
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getFlatrate(): GenericCollection
    {
        return $this->flatrate;
    }

    /**
     * @param GenericCollection $flatrate
     * @return self
     */
    public function setFlatrate(GenericCollection $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getRent(): GenericCollection
    {
        return $this->rent;
    }

    /**
     * @param GenericCollection $rent
     * @return self
     */
    public function setRent(GenericCollection $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getBuy(): GenericCollection
    {
        return $this->buy;
    }

    /**
     * @param GenericCollection $buy
     * @return self
     */
    public function setBuy(GenericCollection $buy): self
    {
        $this->buy = $buy;

        return $this;
    }
}
