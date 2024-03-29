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

namespace Tmdb\Factory;

use Tmdb\Model\Collection\Jobs;
use Tmdb\Model\Job;

/**
 * Class JobsFactory
 * @package Tmdb\Factory
 */
class JobsFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = []): Jobs
    {
        $collection = new Jobs();

        if (array_key_exists('jobs', $data)) {
            $data = $data['jobs'];
        }

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data = []): Job
    {
        return $this->hydrate(new Job(), $data);
    }
}
