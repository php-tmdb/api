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
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    /**
     * @param string|null $logoPath
     * @return $this
     */
    public function setLogoPath($logoPath)
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDisplayPriority()
    {
        return $this->displayPriority;
    }

    /**
     * @param int|null $displayPriority
     * @return $this
     */
    public function setDisplayPriority($displayPriority)
    {
        $this->displayPriority = $displayPriority;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
