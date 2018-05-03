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
 * @version 0.0.1
 */
namespace Tmdb\Model\Movie\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

/**
 * Class AppendToResponse
 * @package Tmdb\Model\Movie\QueryParameter
 */
final class AppendToResponse extends BaseAppendToResponse
{
    const ALTERNATIVE_TITLES = 'alternative_titles';
    const CREDITS            = 'credits';
    const IMAGES             = 'images';
    const KEYWORDS           = 'keywords';
    /**
     * @see https://developers.themoviedb.org/3/movies/get-movie-release-dates
     * @deprecated Use RELEASE_DATES instead, but format has changed.
     */
    const RELEASES           = 'releases';
    const RELEASE_DATES      = 'release_dates';
    const TRANSLATIONS       = 'translations';
    const SIMILAR            = 'similar';
    const RECOMMENDATIONS    = 'recommendations';
    const REVIEWS            = 'reviews';
    const LISTS              = 'lists';
    const CHANGES            = 'changes';
    const VIDEOS             = 'videos';
}
