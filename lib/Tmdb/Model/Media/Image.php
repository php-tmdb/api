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
 * @version 0.0.1
 */
namespace Tmdb\Model\Media;

/**
 * Class Image
 * @package Tmdb\Model
 */
class Image extends \Tmdb\Model\Image
{
    private $imageType;
    private $media;
    private $mediaType;

    public static $properties = array(
        'image_type',
        'media_type',
        'file_path',
        'width',
        'height',
        'iso_639_1',
        'aspect_ratio',
        'vote_average',
        'vote_count'
    );

    /**
     * @param  mixed $imageType
     * @return $this
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * @param  mixed $media
     * @return $this
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param  mixed $mediaType
     * @return $this
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

}
