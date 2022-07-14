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

namespace Tmdb\Model\Common\Change;

use DateTime;
use Tmdb\Model\AbstractModel;

/**
 * Class Item
 * @package Tmdb\Model\Common\Change
 */
class Item extends AbstractModel
{
    public static $properties = [
        'id',
        'action',
        'time',
        'value'
    ];
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $action;
    /**
     * @var DateTime
     */
    private $time;
    /**
     * @var array
     */
    private $value;

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return self
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

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
     * @return DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string|DateTime|null $time
     * @return self
     */
    public function setTime($time = null)
    {
        if (!$time instanceof DateTime && $time !== null) {
            $time = new DateTime($time);
        }

        $this->time = $time;

        return $this;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
