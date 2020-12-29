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

namespace Tmdb\Model\Tv\Season\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

/**
 * Class AppendToResponse
 * @package Tmdb\Model\Tv\Season\QueryParameter
 */
class AppendToResponse extends BaseAppendToResponse
{
    public const CREDITS = 'credits';
    public const EXTERNAL_IDS = 'external_ids';
    public const IMAGES = 'images';
    public const VIDEOS = 'videos';
    public const CHANGES = 'changes';
}
