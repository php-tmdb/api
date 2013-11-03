<?php
namespace Tmdb\Model\Movie\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

final class AppendToResponse extends BaseAppendToResponse {
    const ALTERNATIVE_TITLES = 'alternative_titles';
    const CREDITS            = 'credits';
    const IMAGES             = 'images';
    const KEYWORDS           = 'keywords';
    const RELEASES           = 'releases';
    const TRAILERS           = 'trailers';
    const TRANSLATIONS       = 'translations';
    const SIMILAR_MOVIES     = 'similar_movies';
    const REVIEWS            = 'movies_reviews';
    const LISTS              = 'lists';
    const CHANGES            = 'changes';
}