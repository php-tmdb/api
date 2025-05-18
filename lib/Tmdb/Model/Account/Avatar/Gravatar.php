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

namespace Tmdb\Model\Account\Avatar;

use Tmdb\Model\AbstractModel;

/**
 * Class Gravatar.
 */
class Gravatar extends AbstractModel
{
    /**
     * @var array
     */
    public static $properties = [
        'hash',
    ];
    /**
     * @var string
     */
    private $hash;

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash): static
    {
        $this->hash = $hash;

        return $this;
    }
}
