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

namespace Tmdb\Model\Collection;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\People\PersonInterface;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class People
 *
 * @template T of AbstractModel&PersonInterface
 * @extends GenericCollection<T>
 *
 * @package Tmdb\Model\Collection
 */
class People extends GenericCollection
{
    /**
     * Returns all people
     *
     * @return T[]
     */
    public function getPeople()
    {
        return $this->data;
    }

    /**
     * Retrieve a person from the collection
     *
     * @param $id
     *
     * @return T|null
     */
    public function getPerson($id): ?PersonInterface
    {
        return $this->filterId($id);
    }

    /**
     * Add a person to the collection
     *
     * @param T $person
     *
     * @return void
     */
    public function addPerson(PersonInterface $person): void
    {
        $this->data[] = $person;
    }
}
