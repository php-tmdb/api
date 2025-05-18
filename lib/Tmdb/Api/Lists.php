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
 * Class Lists.
 *
 * @see http://docs.themoviedb.apiary.io/#lists
 */
class Lists extends AbstractApi
{
    /**
     * Get a list by id.
     */
    public function getList(string $list_id, array $parameters = [], array $headers = []): array
    {
        return $this->get('list/' . $list_id, $parameters, $headers);
    }

    /**
     * This method lets users create a new list. A valid session id is required.
     *
     * @param string $name
     * @param string $description
     */
    public function createList($name, $description, array $parameters = [], array $headers = []): array
    {
        return $this->postJson('list', ['name' => $name, 'description' => $description], $parameters, $headers);
    }

    /**
     * Check to see if a movie ID is already added to a list.
     *
     * @param int    $movieId
     */
    public function getItemStatus(string $id, $movieId, array $parameters = [], array $headers = []): array
    {
        return $this->get(
            'list/' . $id . '/item_status',
            array_merge($parameters, ['movie_id' => $movieId]),
            $headers,
        );
    }

    /**
     * This method lets users add new movies to a list that they created. A valid session id is required.
     *
     * @param string|int $mediaId
     */
    public function addMediaToList(string $id, $mediaId): array
    {
        return $this->postJson('list/' . $id . '/add_item', ['media_id' => $mediaId]);
    }

    /**
     * This method lets users delete movies from a list that they created. A valid session id is required.
     *
     * @param string|int $mediaId
     */
    public function removeMediaFromList(string $id, $mediaId): array
    {
        return $this->postJson('list/' . $id . '/remove_item', ['media_id' => $mediaId]);
    }

    /**
     * This method lets users delete a list that they created. A valid session id is required.
     */
    public function deleteList(string $id): array
    {
        return $this->delete('list/' . $id);
    }

    /**
     * Clear all of the items within a list.
     *
     * This is a irreversible action and should be treated with caution.
     * A valid session id is required.
     *
     * @param bool   $confirm
     */
    public function clearList(string $id, $confirm): array
    {
        return $this->post(
            'list/' . $id . '/clear',
            null,
            ['confirm' => (bool) $confirm ? 'true' : 'false'],
        );
    }
}
