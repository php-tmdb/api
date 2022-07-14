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

use Tmdb\Model\Credits\Media;

/**
 * Class Credits
 * @package Tmdb\Model
 */
class Credits extends AbstractModel
{
    /**
     * @var array
     */
    public static $properties = [
        'credit_type',
        'department',
        'job',
        'media_type',
        'id',
    ];
    /**
     * @var string
     */
    private $creditType;
    /**
     * @var string
     */
    private $department;
    /**
     * @var string
     */
    private $job;
    /**
     * @var Media
     */
    private $media;
    /**
     * @var string
     */
    private $mediaType;
    /**
     * @var string
     */
    private $id;
    /**
     * @var Person
     */
    private $person;

    public function __construct()
    {
        $this->media = new Media();
    }

    /**
     * @return string
     */
    public function getCreditType()
    {
        return $this->creditType;
    }

    /**
     * @param string $creditType
     * @return self
     */
    public function setCreditType($creditType)
    {
        $this->creditType = $creditType;

        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return self
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

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
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param string $job
     * @return self
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param Media $media
     * @return self
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     * @return self
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @return self
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }
}
