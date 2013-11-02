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
namespace Tmdb\Model\Common;

use Tmdb\Model\Person;

class People extends Collection {

    /**
     * Returns all people
     *
     * @return array
     */
    public function getPeople()
    {
        return $this->data;
    }

    /**
     * Retrieve a person from the collection
     *
     * @param $id
     * @return null
     */
    public function getPerson($id) {
        foreach($this->data as $person) {
            if ($id === $person->getId()) {
                return $person;
            }
        }

        return null;
    }

    /**
     * Add a person to the collection
     *
     * @param Person $person
     */
    public function addPerson(Person $person)
    {
        $this->data[] = $person;
    }
} 