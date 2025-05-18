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

namespace Tmdb\Model\Collection;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Filter\ImageFilter;
use Tmdb\Model\Image;

/**
 * Class Images.
 *
 * @extends GenericCollection<Image>
 */
class Images extends GenericCollection
{
    /**
     * Returns all images.
     *
     * @return Image[]
     */
    public function getImages()
    {
        return $this->data;
    }

    /**
     * Retrieve a image from the collection.
     */
    public function getImage($id): ?Image
    {
        return $this->filterId($id);
    }

    /**
     * Add a image to the collection.
     */
    public function addImage(Image $image): void
    {
        $this->add(null, $image);
    }

    /**
     * Filter poster images.
     *
     * @return static
     */
    public function filterPosters()
    {
        return $this->filter(
            function ($key, $value) {
                if ($value instanceof ImageFilter && $value instanceof Image\PosterImage) {
                    return true;
                }
            },
        );
    }

    /**
     * Filter backdrop images.
     *
     * @return static
     */
    public function filterBackdrops()
    {
        return $this->filter(
            function ($key, $value) {
                if ($value instanceof ImageFilter && $value instanceof Image\BackdropImage) {
                    return true;
                }
            },
        );
    }

    /**
     * Filter profile images.
     *
     * @return static
     */
    public function filterProfile()
    {
        return $this->filter(
            function ($key, $value) {
                if ($value instanceof ImageFilter && $value instanceof Image\ProfileImage) {
                    return true;
                }
            },
        );
    }

    /**
     * Filter still images.
     *
     * @return static
     */
    public function filterStills()
    {
        return $this->filter(
            function ($key, $value) {
                if ($value instanceof ImageFilter && $value instanceof Image\StillImage) {
                    return true;
                }
            },
        );
    }

    /**
     * Filter by image size.
     *
     * @return static
     */
    public function filterMaxWidth($width)
    {
        return $this->filter(
            function ($key, $value) use ($width) {
                if ($value instanceof Image && $value->getWidth() <= $width && null !== $value->getWidth()) {
                    return true;
                }
            },
        );
    }

    /**
     * Filter by image size.
     *
     * @return static
     */
    public function filterMinWidth($width)
    {
        return $this->filter(
            function ($key, $value) use ($width) {
                if ($value instanceof Image && $value->getWidth() >= $width && null !== $value->getWidth()) {
                    return true;
                }
            },
        );
    }

    /**
     * Filter by image size.
     *
     * @return static
     */
    public function filterMaxHeight($height)
    {
        return $this->filter(
            function ($key, $value) use ($height) {
                if (
                    $value instanceof Image
                    && $value->getHeight() <= $height && null !== $value->getHeight()
                ) {
                    return true;
                }
            },
        );
    }

    /**
     * Filter by image size.
     *
     * @return static
     */
    public function filterMinHeight($height)
    {
        return $this->filter(
            function ($key, $value) use ($height) {
                if (
                    $value instanceof Image
                    && $value->getHeight() >= $height
                    && null !== $value->getHeight()
                ) {
                    return true;
                }
            },
        );
    }

    /**
     * Return a single image that is rated highest.
     *
     * @return ImageFilter|null
     */
    public function filterBestVotedImage()
    {
        $currentImage = null;
        $voteAverage = -1;

        foreach ($this->data as $image) {
            /**
             * @var Image $image
             */
            if ($image->getVoteAverage() > $voteAverage) {
                $voteAverage = $image->getVoteAverage();
                $currentImage = $image;
            }
        }

        return $currentImage;
    }
}
