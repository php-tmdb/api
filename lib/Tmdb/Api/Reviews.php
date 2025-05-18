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

namespace Tmdb\Api;

/**
 * Class Reviews.
 *
 * @see http://docs.themoviedb.apiary.io/#reviews
 */
class Reviews extends AbstractApi
{
    /**
     * Get the full details of a review by ID.
     */
    public function getReview(string $review_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('review/' . $review_id, $parameters, $headers);
    }
}
