<?php
namespace Tmdb\Model\Tv\QueryParameter;

use Tmdb\Model\Common\QueryParameter\AppendToResponse as BaseAppendToResponse;

class AppendToResponse extends BaseAppendToResponse {
    const ALTERNATIVE_TITLES = 'alternative_titles';
    const EXTERNAL_IDS       = 'external_ids';
    const IMAGES             = 'images';
}