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

namespace Tmdb\Model\Person\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

/**
 * Class AppendToResponse.
 */
final class AppendToResponse extends BaseAppendToResponse
{
    public const string MOVIE_CREDITS = 'movie_credits';
    public const string TV_CREDITS = 'tv_credits';
    public const string COMBINED_CREDITS = 'combined_credits';
    public const string IMAGES = 'images';
    public const string CHANGES = 'changes';
    public const string EXTERNAL_IDS = 'external_ids';
    public const string TAGGED_IMAGES = 'tagged_images';
}
