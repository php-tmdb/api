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
 * Class Configuration.
 */
class Configuration extends AbstractModel
{
    public static $properties = [
        'images',
        'change_keys',
    ];
    private ?array $images = null;
    private ?array $change_keys = null;

    /**
     * @return array
     */
    public function getChangeKeys()
    {
        return $this->change_keys;
    }

    public function setChangeKeys(array $change_keys = []): static
    {
        $this->change_keys = $change_keys;

        return $this;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    public function setImages(array $images = []): static
    {
        $this->images = $images;

        return $this;
    }
}
