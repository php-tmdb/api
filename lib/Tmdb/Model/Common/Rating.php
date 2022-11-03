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

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;

/**
 * Class Rating
 * @package Tmdb\Model\Common
 */
class Rating extends AbstractModel
{
    public static $properties = [
        'value',
    ];
    /**
     * @var float
     */
    private $value;

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
