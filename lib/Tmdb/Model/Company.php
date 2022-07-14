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

use Tmdb\Model\Image\LogoImage;

/**
 * Class Company
 * @package Tmdb\Model
 */
class Company extends AbstractModel
{
    public static $properties = [
        'description',
        'headquarters',
        'homepage',
        'id',
        'logo_path',
        'name',
        'parent_company'
    ];
    private $description;
    private $headquarters;
    private $homepage;
    private $id;
    private $logo;
    private $logoPath;
    private $name;
    private $parentCompany;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeadquarters()
    {
        return $this->headquarters;
    }

    /**
     * @param mixed $headquarters
     * @return self
     */
    public function setHeadquarters($headquarters)
    {
        $this->headquarters = $headquarters;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param mixed $homepage
     * @return self
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

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
     * @param LogoImage $logo
     * @return self
     */
    public function setLogoImage(LogoImage $logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return LogoImage
     */
    public function getLogoImage()
    {
        return $this->logo;
    }

    /**
     * @return mixed
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    /**
     * @param mixed $logoPath
     * @return self
     */
    public function setLogoPath($logoPath)
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentCompany()
    {
        return $this->parentCompany;
    }

    /**
     * @param mixed $parentCompany
     * @return self
     */
    public function setParentCompany($parentCompany)
    {
        $this->parentCompany = $parentCompany;

        return $this;
    }
}
