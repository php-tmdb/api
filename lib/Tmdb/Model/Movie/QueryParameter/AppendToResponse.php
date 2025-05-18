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

namespace Tmdb\Model\Movie\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

/**
 * Class AppendToResponse.
 */
final class AppendToResponse extends BaseAppendToResponse
{
    public const string ALTERNATIVE_TITLES = 'alternative_titles';
    public const string EXTERNAL_IDS = 'external_ids';
    public const string CREDITS = 'credits';
    public const string IMAGES = 'images';
    public const string KEYWORDS = 'keywords';
    /**
     * @see https://developers.themoviedb.org/3/movies/get-movie-release-dates
     * @deprecated use RELEASE_DATES instead, but format has changed
     */
    public const string RELEASES = 'releases';
    public const string RELEASE_DATES = 'release_dates';
    public const string TRANSLATIONS = 'translations';
    public const string SIMILAR = 'similar';
    public const string RECOMMENDATIONS = 'recommendations';
    public const string REVIEWS = 'reviews';
    public const string LISTS = 'lists';
    public const string CHANGES = 'changes';
    public const string VIDEOS = 'videos';
    public const string WATCH_PROVIDERS = 'watch/providers';
}
