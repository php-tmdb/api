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
use Tmdb\Model\Filter\CountryFilter;

/**
 * Class Watch Provider.
 */
class Provider extends AbstractModel implements CountryFilter
{
    public static $properties = [
        'iso_3166_1',
        'id',
        'name',
        'logo_path',
        'display_priority',
        'type',
    ];
    private ?string $iso31661 = null;
    private ?int $id = null;
    private ?string $name = null;
    private ?string $logoPath = null;
    private ?int $displayPriority = null;
    private ?string $type = null;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(?string $logoPath): self
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getDisplayPriority(): ?int
    {
        return $this->displayPriority;
    }

    public function setDisplayPriority(?int $displayPriority): self
    {
        $this->displayPriority = $displayPriority;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
