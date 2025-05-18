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
 * Class Collections.
 *
 * @see http://docs.themoviedb.apiary.io/#collections
 */
class Collections extends AbstractApi
{
    /**
     * Get the basic collection information for a specific collection id.
     *
     * You can get the ID needed for this method by making a /movie/{id} request
     * and paying attention to the belongs_to_collection hash.
     *
     * Movie parts are not sorted in any particular order.
     * If you would like to sort them yourself you can use the provided release_date.
     */
    public function getCollection(string $collection_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('collection/' . $collection_id, $parameters, $headers);
    }

    /**
     * Get all of the images for a particular collection by collection id.
     */
    public function getImages(string $collection_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('collection/' . $collection_id . '/images', $parameters, $headers);
    }

    /**
     * Get the list of translations that exist for a TV episode.
     */
    public function getTranslations(string $collection_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('collection/' . $collection_id . '/translations', $parameters, $headers);
    }
}
