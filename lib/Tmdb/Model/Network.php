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

namespace Tmdb\Model;

/**
 * Class Network
 * @package Tmdb\Model
 */
class Network extends AbstractModel
{
    /**
     * Properties that are available in the API
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
        'origin_country'
    ];

    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $headquarters;

    /**
     * @var string
     */
    private $homepage;

    /**
     * @var string|null
     */
    private $logoPath;

    /**
     * @var string
     */
    private $originCountry;


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int)$id;

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
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeadquarters(): string
    {
        return $this->headquarters;
    }

    /**
     * @param string $headquarters
     * @return Network
     */
    public function setHeadquarters(string $headquarters): Network
    {
        $this->headquarters = $headquarters;

        return $this;
    }

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     * @return Network
     */
    public function setHomepage(string $homepage): Network
    {
        $this->homepage = $homepage;

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
     * @return Network
     */
    public function setLogoPath(?string $logoPath): Network
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginCountry(): string
    {
        return $this->originCountry;
    }

    /**
     * @param string $originCountry
     * @return Network
     */
    public function setOriginCountry(string $originCountry): Network
    {
        $this->originCountry = $originCountry;

        return $this;
    }
}
