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

namespace Tmdb\Model\Common\Video;

use Tmdb\Model\Common\Video;

/**
 * Class Youtube.
 */
class Youtube extends Video
{
    public const URL_FORMAT = 'http://www.youtube.com/watch?v=%s';

    public function __construct()
    {
        $this->setUrlFormat(self::URL_FORMAT);
    }
}
