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
 * @version 4.0.0
 */

namespace Tmdb\Factory\Movie;

use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Movie\AlternativeTitle;

/**
 * Class AlternativeTitleFactory
 * @package Tmdb\Factory\Movie
 */
class AlternativeTitleFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = []): GenericCollection
    {
        $collection = new GenericCollection();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data = []): AlternativeTitle
    {
        $title = new AlternativeTitle();

        return $this->hydrate($title, $data);
    }
}
