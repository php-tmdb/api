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
 * @version 0.0.1
 */

namespace Tmdb\Model\Collection;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Collection\People\PersonInterface;
use Tmdb\Model\Person;

/**
 * Class People
 * @package Tmdb\Model\Collection
 */
class People extends GenericCollection
{
    /**
     * Returns all people
     *
     * @return Person[]
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
     * @return GenericCollection
     */
    public function getPerson($id): GenericCollection
    {
        return $this->filterId($id);
    }

    /**
     * Add a person to the collection
     *
     * @param PersonInterface $person
     *
     * @return void
     */
    public function addPerson(PersonInterface $person): void
    {
        $this->data[] = $person;
    }
}
