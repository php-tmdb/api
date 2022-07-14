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

namespace Tmdb\Model\Lists;

use Tmdb\Model\AbstractModel;

/**
 * Class ItemStatus
 * @package Tmdb\Model\Lists
 */
class ItemStatus extends AbstractModel
{
    /**
     * @var array
     */
    public static $properties = [
        'id',
        'item_present'
    ];
    /**
     * @var string
     */
    private $id;
    /**
     * @var boolean
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
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getItemPresent()
    {
        return $this->itemPresent;
    }

    /**
     * @param boolean $itemPresent
     * @return self
     */
    public function setItemPresent($itemPresent)
    {
        $this->itemPresent = $itemPresent;

        return $this;
    }
}
