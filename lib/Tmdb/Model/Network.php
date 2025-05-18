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

namespace Tmdb\Model;

/**
 * Class Network.
 */
class Network extends AbstractModel
{
    /**
     * Properties that are available in the API.
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'id',
        'name',
        'headquarters',
        'homepage',
        'logo_path',
        'origin_country',
    ];

    private ?int $id = null;
    /**
     * @var string
     */
    private $name;
    private ?string $headquarters = null;

    private ?string $homepage = null;

    private ?string $logoPath = null;

    private ?string $originCountry = null;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): static
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getHeadquarters(): string
    {
        return $this->headquarters;
    }

    public function setHeadquarters(string $headquarters): Network
    {
        $this->headquarters = $headquarters;

        return $this;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): Network
    {
        $this->homepage = $homepage;

        return $this;
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(?string $logoPath): Network
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getOriginCountry(): string
    {
        return $this->originCountry;
    }

    public function setOriginCountry(string $originCountry): Network
    {
        $this->originCountry = $originCountry;

        return $this;
    }
}
