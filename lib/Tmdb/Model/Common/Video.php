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

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Filter\CountryFilter;
use Tmdb\Model\Filter\LanguageFilter;

/**
 * Class Video.
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
        'type',
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
     * Holds the format of the url.
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
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    #[\Override]
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param string $iso6391
     */
    public function setIso6391($iso6391): static
    {
        $this->iso6391 = $iso6391;

        return $this;
    }

    /**
     * @return string
     */
    #[\Override]
    public function getIso31661()
    {
        return $this->iso31661;
    }

    /**
     * @param string $iso31661
     */
    public function setIso31661($iso31661): static
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
     */
    public function setName($name): static
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
     */
    public function setSite($site): static
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
     */
    public function setSize($size): static
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
     */
    public function setType($type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Retrieve the url to the source.
     */
    public function getUrl(): string
    {
        return \sprintf($this->getUrlFormat(), $this->getKey());
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
     */
    public function setUrlFormat($url_format): static
    {
        $this->url_format = $url_format;

        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key): static
    {
        $this->key = $key;

        return $this;
    }
}
