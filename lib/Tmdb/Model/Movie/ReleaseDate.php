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

namespace Tmdb\Model\Movie;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Filter\CountryFilter;
use Tmdb\Model\Filter\LanguageFilter;

/**
 * Class Release Date
 * @package Tmdb\Model\Movie
 */
class ReleaseDate extends AbstractModel implements CountryFilter, LanguageFilter
{
    public const PREMIERE = 1;
    public const THEATRICAL_LIMITED = 2;
    public const THEATRICAL = 3;
    public const DIGITAL = 4;
    public const PHYSICAL = 5;
    public const TV = 6;
    public static $properties = [
        'iso_3166_1',
        'iso_639_1',
        'certification',
        'note',
        'release_date',
        'type'
    ];
    private $iso31661;
    private $iso6391;
    private $certification;
    private $note;
    private $releaseDate;
    private $type;

    /**
     * @return string|null
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param string|null $certification
     * @return self
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return self
     */
    public function setNote($note)
    {
        $this->note = $note;

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
     * @return DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param string|DateTime|null $releaseDate
     * @return self
     */
    public function setReleaseDate($releaseDate = null)
    {
        if (!$releaseDate instanceof DateTime && $releaseDate !== null) {
            $releaseDate = new DateTime($releaseDate);
        }

        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return string|null
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
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
