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

use Tmdb\Model\Change;
use Tmdb\Model\Collection\Changes;

/**
 * Class ChangesFactory.
 */
class ChangesFactory extends AbstractFactory
{
    #[\Override]
    public function createCollection(array $data = []): Changes
    {
        $collection = new Changes();

        if (\array_key_exists('page', $data)) {
            $collection->setPage($data['page']);
        }

        if (\array_key_exists('total_pages', $data)) {
            $collection->setTotalPages($data['total_pages']);
        }

        if (\array_key_exists('total_results', $data)) {
            $collection->setTotalResults($data['total_results']);
        }

        if (\array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): Change
    {
        return $this->hydrate(new Change(), $data);
    }
}
