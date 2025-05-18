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

/**
 * Class Review.
 */
class Review extends AbstractModel
{
    public static $properties = [
        'id',
        'author',
        'content',
        'iso_639_1',
        'media_id',
        'media_title',
        'media_type',
        'url',
    ];
    private $id;
    private $author;
    private $content;
    private $iso6391;
    private $mediaId;
    private $mediaTitle;
    private $mediaType;
    private $url;

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getIso6391()
    {
        return $this->iso6391;
    }

    public function setIso6391($iso6391): static
    {
        $this->iso6391 = $iso6391;

        return $this;
    }

    public function getMediaId()
    {
        return $this->mediaId;
    }

    public function setMediaId($mediaId): static
    {
        $this->mediaId = $mediaId;

        return $this;
    }

    public function getMediaTitle()
    {
        return $this->mediaTitle;
    }

    public function setMediaTitle($mediaTitle): static
    {
        $this->mediaTitle = $mediaTitle;

        return $this;
    }

    public function getMediaType()
    {
        return $this->mediaType;
    }

    public function setMediaType($mediaType): static
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url): static
    {
        $this->url = $url;

        return $this;
    }
}
