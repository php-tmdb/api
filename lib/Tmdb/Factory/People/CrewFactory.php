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

namespace Tmdb\Factory\People;

use Tmdb\Factory\PeopleFactory;
use Tmdb\Model\Collection\People\Crew;
use Tmdb\Model\Person\CrewMember;

/**
 * Class CrewFactory.
 *
 * @extends PeopleFactory<CrewMember>
 */
class CrewFactory extends PeopleFactory
{
    /**
     * @param CrewMember|null $person
     */
    #[\Override]
    public function createCollection(array $data = [], $person = null, $collection = null): Crew
    {
        $collection = new Crew();

        $class = \is_object($person) ? $person::class : \Tmdb\Model\Person\CrewMember::class;

        foreach ($data as $item) {
            $collection->add(null, $this->create($item, new $class()));
        }

        return $collection;
    }
}
