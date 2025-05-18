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
 * Class Result.
 */
class Result extends AbstractModel
{
    /**
     * @var array
     */
    public static $properties = [
        'status_code',
        'status_message',
    ];
    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var string
     */
    private $statusMessage;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * @param string $statusMessage
     */
    public function setStatusMessage($statusMessage): static
    {
        $this->statusMessage = $statusMessage;

        return $this;
    }
}
