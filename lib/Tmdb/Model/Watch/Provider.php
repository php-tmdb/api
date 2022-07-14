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
use Tmdb\Model\Filter\CountryFilter;

/**
 * Class Watch Provider
 * @package Tmdb\Model\Watch
 */
class Provider extends AbstractModel implements CountryFilter
{
    public static $properties = [
        'iso_3166_1',
        'id',
        'name',
        'logo_path',
        'display_priority',
        'type'
    ];
    private $iso31661;
    private $id;
    private $name;
    private $logoPath;
    private $displayPriority;
    private $type;

    /**
     * @return string|null
     */
    public function getIso31661(): ?string
    {
        return $this->iso31661;
    }

    /**
     * @param string $iso31661|null
     * @return self
     */
    public function setIso31661(?string $iso31661): self
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    /**
     * @param string|null $logoPath
     * @return self
     */
    public function setLogoPath(?string $logoPath): self
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDisplayPriority(): ?int
    {
        return $this->displayPriority;
    }

    /**
     * @param int|null $displayPriority
     * @return self
     */
    public function setDisplayPriority(?int $displayPriority): self
    {
        $this->displayPriority = $displayPriority;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
