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

namespace Tmdb\Model\Tv\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

/**
 * Class AppendToResponse
 * @package Tmdb\Model\Tv\QueryParameter
 */
class AppendToResponse extends BaseAppendToResponse
{
    public const CREDITS = 'credits';
    public const EXTERNAL_IDS = 'external_ids';
    public const IMAGES = 'images';
    public const TRANSLATIONS = 'translations';
    public const VIDEOS = 'videos';
    public const CHANGES = 'changes';
    public const KEYWORDS = 'keywords';
    public const SIMILAR = 'similar';
    public const RECOMMENDATIONS = 'recommendations';
    public const CONTENT_RATINGS = 'content_ratings';
    public const ALTERNATIVE_TITLES = 'alternative_titles';
    public const WATCH_PROVIDERS = 'watch/providers';
    public const EPISODE_GROUPS = 'episode_groups';
}
