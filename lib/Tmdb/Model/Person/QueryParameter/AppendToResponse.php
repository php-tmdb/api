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

namespace Tmdb\Model\Person\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

/**
 * Class AppendToResponse
 * @package Tmdb\Model\Person\QueryParameter
 */
final class AppendToResponse extends BaseAppendToResponse
{
    public const MOVIE_CREDITS = 'movie_credits';
    public const TV_CREDITS = 'tv_credits';
    public const COMBINED_CREDITS = 'combined_credits';
    public const IMAGES = 'images';
    public const CHANGES = 'changes';
    public const EXTERNAL_IDS = 'external_ids';
    public const TAGGED_IMAGES = 'tagged_images';
}
