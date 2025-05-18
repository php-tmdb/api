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

use Tmdb\Model\Image\LogoImage;

/**
 * Class Company.
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
        'parent_company',
    ];
    private $description;
    private $headquarters;
    private $homepage;
    private ?int $id = null;
    private ?\Tmdb\Model\Image\LogoImage $logo = null;
    private $logoPath;
    private $name;
    private $parentCompany;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getHeadquarters()
    {
        return $this->headquarters;
    }

    public function setHeadquarters($headquarters): static
    {
        $this->headquarters = $headquarters;

        return $this;
    }

    public function getHomepage()
    {
        return $this->homepage;
    }

    public function setHomepage($homepage): static
    {
        $this->homepage = $homepage;

        return $this;
    }

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

    public function setLogoImage(LogoImage $logo): static
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

    public function getLogoPath()
    {
        return $this->logoPath;
    }

    public function setLogoPath($logoPath): static
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getParentCompany()
    {
        return $this->parentCompany;
    }

    public function setParentCompany($parentCompany): static
    {
        $this->parentCompany = $parentCompany;

        return $this;
    }
}
