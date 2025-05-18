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

namespace Tmdb\Model\Lists;

use Tmdb\Model\AbstractModel;

/**
 * Class ItemStatus.
 */
class ItemStatus extends AbstractModel
{
    /**
     * @var array
     */
    public static $properties = [
        'id',
        'item_present',
    ];
    /**
     * @var string
     */
    private $id;
    /**
     * @var bool
     */
    private $itemPresent;

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
     * @return bool
     */
    public function getItemPresent()
    {
        return $this->itemPresent;
    }

    /**
     * @param bool $itemPresent
     */
    public function setItemPresent($itemPresent): static
    {
        $this->itemPresent = $itemPresent;

        return $this;
    }
}
