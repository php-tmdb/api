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
namespace Tmdb\Repository;

use Tmdb\Factory\People\PeopleFactory;
use Tmdb\Model\Person;

class PersonRepository extends AbstractRepository {
    /**
     * Load a person with the given identifier
     *
     * @param $id
     * @param $parameters
     * @return Person
     */
    public function load($id, array $parameters = array()) {

        if (empty($parameters) && $parameters !== false) {
            // Load a no-nonsense default set
            $parameters = array(
                new \Tmdb\Model\Person\QueryParameter\AppendToResponse(array(
                    \Tmdb\Model\Person\QueryParameter\AppendToResponse::IMAGES,
                ))
            );
        }

        $data = $this->getApi()->getPerson($id, $this->parseQueryParameters($parameters));

        return PeopleFactory::create($data);
    }

    /**
     * If you obtained an person model which is not completely hydrated, you can use this function.
     *
     * @param Person $person
     * @param array $parameters
     * @return Person
     */
    public function refresh(Person $person, array $parameters = array()) {
        return $this->load($person->getId(), $parameters);
    }

    /**
     * @return \Tmdb\Api\People
     */
    public function getApi()
    {
        return $this->getClient()->getPersonApi();
    }
}