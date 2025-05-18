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

namespace Tmdb\Factory\Movie;

use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Movie\AlternativeTitle;

/**
 * Class AlternativeTitleFactory.
 */
class AlternativeTitleFactory extends AbstractFactory
{
    #[\Override]
    public function createCollection(array $data = []): GenericCollection
    {
        $collection = new GenericCollection();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): AlternativeTitle
    {
        $title = new AlternativeTitle();

        return $this->hydrate($title, $data);
    }
}
