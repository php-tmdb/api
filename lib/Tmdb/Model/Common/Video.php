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

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Filter\CountryFilter;
use Tmdb\Model\Filter\LanguageFilter;

/**
 * Class Video
 * @package Tmdb\Model\Common
 */
class Video extends AbstractModel implements CountryFilter, LanguageFilter
{
    public static $properties = [
        'id',
        'iso_639_1',
        'iso_3166_1',
        'key',
        'name',
        'site',
        'size',
        'type'
    ];
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $iso6391;
    /**
     * @var string
     */
    private $iso31661;
    /**
     * @var mixed
     */
    private $key;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $site;
    /**
     * @var int
     */
    private $size;
    /**
     * @var string
     */
    private $type;
    /**
     * Holds the format of the url
     *
     * @var string
     */
    private $url_format;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param string $iso6391
     * @return self
     */
    public function setIso6391($iso6391)
    {
        $this->iso6391 = $iso6391;

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
     * @return self
     */
    public function setIso31661($iso31661)
    {
        $this->iso31661 = $iso31661;

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
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     * @return self
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Retrieve the url to the source
     *
     * @return string
     */
    public function getUrl()
    {
        return sprintf($this->getUrlFormat(), $this->getKey());
    }

    /**
     * @return string
     */
    public function getUrlFormat()
    {
        return $this->url_format;
    }

    /**
     * @param string $url_format
     * @return self
     */
    public function setUrlFormat($url_format)
    {
        $this->url_format = $url_format;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     * @return self
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }
}
