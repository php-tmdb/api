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

/**
 * Class Review
 * @package Tmdb\Model
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
        'url'
    ];
    private $id;
    private $author;
    private $content;
    private $iso6391;
    private $mediaId;
    private $mediaTitle;
    private $mediaType;
    private $url;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
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
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param mixed $iso6391
     * @return self
     */
    public function setIso6391($iso6391)
    {
        $this->iso6391 = $iso6391;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * @param mixed $mediaId
     * @return self
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMediaTitle()
    {
        return $this->mediaTitle;
    }

    /**
     * @param mixed $mediaTitle
     * @return self
     */
    public function setMediaTitle($mediaTitle)
    {
        $this->mediaTitle = $mediaTitle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param mixed $mediaType
     * @return self
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
