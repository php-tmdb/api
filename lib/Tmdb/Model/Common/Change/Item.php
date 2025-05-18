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

namespace Tmdb\Model\Common\Change;

use DateTime;
use Tmdb\Model\AbstractModel;

/**
 * Class Item.
 */
class Item extends AbstractModel
{
    public static $properties = [
        'id',
        'action',
        'time',
        'value',
    ];
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $action;
    private ?\DateTime $time = null;
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
     */
    public function setAction($action): static
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
     */
    public function setId($id): static
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
     */
    public function setTime($time = null): static
    {
        if (!$time instanceof DateTime && null !== $time) {
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
     */
    public function setValue($value): static
    {
        $this->value = $value;

        return $this;
    }
}
