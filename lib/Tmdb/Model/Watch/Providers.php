<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Neil Daniels <neil.here@gmail.com>
 * @copyright (c) 2021, Neil Daniels
 *
 * @version 4.0.0
 */

namespace Tmdb\Model\Watch;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Filter\CountryFilter;

/**
 * Class Watch Providers.
 */
class Providers extends AbstractModel implements CountryFilter
{
    public static $properties = [
        'iso_3166_1',
        'link',
        'flatrate',
        'rent',
        'buy',
    ];
    private ?string $iso31661 = null;
    private ?string $link = null;
    private \Tmdb\Model\Common\GenericCollection $flatrate;
    private \Tmdb\Model\Common\GenericCollection $rent;
    private \Tmdb\Model\Common\GenericCollection $buy;

    /**
     * Constructor.
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->flatrate = new GenericCollection();
        $this->rent = new GenericCollection();
        $this->buy = new GenericCollection();
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    #[\Override]
    public function getIso31661(): ?string
    {
        return $this->iso31661;
    }

    public function setIso31661(?string $iso31661): self
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    public function getFlatrate(): GenericCollection
    {
        return $this->flatrate;
    }

    public function setFlatrate(GenericCollection $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    public function getRent(): GenericCollection
    {
        return $this->rent;
    }

    public function setRent(GenericCollection $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    public function getBuy(): GenericCollection
    {
        return $this->buy;
    }

    public function setBuy(GenericCollection $buy): self
    {
        $this->buy = $buy;

        return $this;
    }
}
