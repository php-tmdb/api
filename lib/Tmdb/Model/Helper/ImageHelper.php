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
namespace Tmdb\Model\Helper;

use Tmdb\Model\Configuration;
use Tmdb\Model\Image;

class ImageHelper {

    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function getImageConfiguration()
    {
        return $this->config->getImages();
    }

    public function getUrl(Image $image, $size = 'original') {
        $config = $this->getImageConfiguration();

        return sprintf('%s%s%s', $config['base_url'] , $size, $image->getFilePath());
    }

    public function getHtml(Image $image, $size = 'original') {
        return sprintf(
            '<img src="%s" height="%s" width="%s" />',
            $this->getUrl($image, $size),
            $image->getHeight(),
            $image->getWidth()
        );
    }
}