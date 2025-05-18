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

namespace Tmdb\Repository;

use Tmdb\Api\Reviews;
use Tmdb\Factory\ReviewFactory;
use Tmdb\Model\Review;

/**
 * Class ReviewRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#reviews
 */
class ReviewRepository extends AbstractRepository
{
    /**
     * Get the full details of a review by ID.
     */
    public function load(string $id, array $parameters = [], array $headers = []): \Tmdb\Model\Review
    {
        return $this->getFactory()->create(
            $this->getApi()->getReview($id, $parameters, $headers),
        );
    }

    #[\Override]
    public function getFactory(): \Tmdb\Factory\ReviewFactory
    {
        return new ReviewFactory($this->getClient()->getHttpClient());
    }

    /**
     * Return the related API class.
     *
     * @return Reviews
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getReviewsApi();
    }
}
