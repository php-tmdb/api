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

namespace Tmdb\Helper;

use Tmdb\Model\Configuration;
use Tmdb\Model\Image;

/**
 * Class ImageHelper.
 */
class ImageHelper
{
    protected $protocolLessBaseUrl;

    public function __construct(private readonly Configuration $config)
    {
        $imagesConfig = $this->config->getImages();

        $this->protocolLessBaseUrl = str_contains((string) $imagesConfig['base_url'], 'http:') ?
            substr(
                (string) $imagesConfig['base_url'],
                5,
                \strlen((string) $imagesConfig['base_url']) - 5,
            ) :
            $imagesConfig['base_url'];
    }

    /**
     * Load the image configuration collection.
     *
     * @return array
     */
    public function getImageConfiguration()
    {
        return $this->config->getImages();
    }

    /**
     * Get an img html tag for the image in the specified size.
     *
     * @param Image|string $image  Either an instance of Image or the file_path
     * @param string       $size
     * @param int|null     $width
     * @param int|null     $height
     * @param string       $alt
     * @param string       $title
     */
    public function getHtml($image, $size = 'original', $width = null, $height = null, $alt = '', $title = ''): string
    {
        if ($image instanceof Image) {
            if (null === $image->getFilePath()) {
                return '';
            }

            $aspectRatio = $image->getAspectRatio();

            if (null !== $width && null === $height && null !== $aspectRatio) {
                $height = round($width / $aspectRatio);
            }

            if (null !== $height && null === $width && null !== $aspectRatio) {
                $width = round($height * $aspectRatio);
            }

            if (null === $width) {
                $width = $image->getWidth();
            }

            if (null === $height) {
                $height = $image->getHeight();
            }
        }

        return \sprintf(
            '<img src="%s" width="%s" height="%s" title="%s" alt="%s"/>',
            $this->getUrl($image, $size),
            $width,
            $height,
            $title,
            $alt,
        );
    }

    /**
     * Get the url for the image resource.
     *
     * @param Image|string $image Either an instance of Image or the file_path
     *
     */
    public function getUrl($image, string $size = 'original'): string
    {
        return $this->protocolLessBaseUrl . $size . $image;
    }
}
