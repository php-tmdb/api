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

namespace Tmdb\Model\Collection;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Genre;

/**
 * Class Genres.
 */
class Genres extends GenericCollection
{
    /**
     * Returns all genres.
     *
     * @return Genre[]
     */
    public function getGenres()
    {
        return $this->data;
    }

    /**
     * Retrieve a genre from the collection.
     *
     * @return Genre|null
     */
    public function getGenre($id)
    {
        foreach ($this->data as $genre) {
            if ($id === $genre->getId()) {
                return $genre;
            }
        }

        return null;
    }

    /**
     * Add a genre to the collection.
     */
    public function addGenre(Genre $genre): static
    {
        $this->data[] = $genre;

        return $this;
    }
}
