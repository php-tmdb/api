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

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;

/**
 * Class Change.
 */
class Change extends AbstractModel
{
    public static $properties = [
        'key',
    ];
    /**
     * @var string
     */
    private $key;
    private \Tmdb\Model\Common\GenericCollection $items;

    public function __construct()
    {
        $this->items = new GenericCollection();
    }

    /**
     * @return GenericCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param GenericCollection $items
     */
    public function setItems($items): static
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key): static
    {
        $this->key = $key;

        return $this;
    }
}
