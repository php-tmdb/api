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

namespace Tmdb\Factory;

use Tmdb\Model\Collection\Genres;
use Tmdb\Model\Genre;

/**
 * Class GenreFactory.
 */
class GenreFactory extends AbstractFactory
{
    #[\Override]
    public function createCollection(array $data = [], $key = 'genres'): Genres
    {
        $collection = new Genres();

        if (\array_key_exists($key, $data)) {
            $data = $data[$key];
        }

        foreach ($data as $item) {
            $collection->addGenre($this->create($item));
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): Genre
    {
        return $this->hydrate(new Genre(), $data);
    }
}
