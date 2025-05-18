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

use Tmdb\Model\Credits\Media;

/**
 * Class Credits.
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
    private \Tmdb\Model\Credits\Media $media;
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
     */
    public function setCreditType($creditType): static
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
     */
    public function setDepartment($department): static
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
     */
    public function setId($id): static
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
     */
    public function setJob($job): static
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
     */
    public function setMedia($media): static
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
     */
    public function setMediaType($mediaType): static
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
     */
    public function setPerson($person): static
    {
        $this->person = $person;

        return $this;
    }
}
