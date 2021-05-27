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

namespace Tmdb\Model\Movie\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

/**
 * Class AppendToResponse
 * @package Tmdb\Model\Movie\QueryParameter
 */
final class AppendToResponse extends BaseAppendToResponse
{
    public const ALTERNATIVE_TITLES = 'alternative_titles';
    public const EXTERNAL_IDS = 'external_ids';
    public const CREDITS = 'credits';
    public const IMAGES = 'images';
    public const KEYWORDS = 'keywords';
    /**
     * @see https://developers.themoviedb.org/3/movies/get-movie-release-dates
     * @deprecated Use RELEASE_DATES instead, but format has changed.
     */
    public const RELEASES = 'releases';
    public const RELEASE_DATES = 'release_dates';
    public const TRANSLATIONS = 'translations';
    public const SIMILAR = 'similar';
    public const RECOMMENDATIONS = 'recommendations';
    public const REVIEWS = 'reviews';
    public const LISTS = 'lists';
    public const CHANGES = 'changes';
    public const VIDEOS = 'videos';
    public const WATCH_PROVIDERS = 'watch/providers';
}
