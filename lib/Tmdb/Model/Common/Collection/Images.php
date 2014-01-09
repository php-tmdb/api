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
namespace Tmdb\Model\Common\Collection;

use Tmdb\Model\Common\Collection;

use Tmdb\Model\Image;

class Images extends Collection {

    /**
     * Returns all images
     *
     * @return array
     */
    public function getImages()
    {
        return $this->data;
    }

    /**
     * Retrieve a image from the collection
     *
     * @param $id
     * @return null
     */
    public function getImage($id) {
        foreach($this->data as $image) {
            if ($id === $image->getId()) {
                return $image;
            }
        }

        return null;
    }

    /**
     * Add a image to the collection
     *
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        $this->add(null, $image);
    }
} 