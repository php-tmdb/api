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
 * @version 2.1.7
 */
namespace Tmdb\Model\Movie;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Filter\CountryFilter;
use Tmdb\Model\Filter\LanguageFilter;

/**
 * Class Release Date
 * @package Tmdb\Model\Movie
 */
class ReleaseDate extends AbstractModel implements CountryFilter, LanguageFilter
{
    const PREMIERE = 1;
    const THEATRICAL_LIMITED = 2;
    const THEATRICAL = 3;
    const DIGITAL = 4;
    const PHYSICAL = 5;
    const TV = 6;

    private $iso31661;
    private $iso6391;
    private $certification;
    private $note;
    private $releaseDate;
    private $type;

    public static $properties = [
        'iso_3166_1',
        'iso_639_1',
        'certification',
        'note',
        'release_date',
        'type'
    ];

    /**
     * @param  string|null $certification
     * @return $this
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param  string|null $note
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;

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
     * @param  string $iso31661
     * @return $this
     */
    public function setIso31661($iso31661)
    {
        $this->iso31661 = $iso31661;

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
     * @param  string|\DateTime $releaseDate
     * @return $this
     */
    public function setReleaseDate($releaseDate)
    {
        if (!$releaseDate instanceof \DateTime) {
            $releaseDate = new \DateTime($releaseDate);
        }

        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param string $iso6391
     * @return $this
     */
    public function setIso6391($iso6391)
    {
        $this->iso6391 = $iso6391;
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
     * @param int $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}