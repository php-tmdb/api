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
use Tmdb\Model\Collection\People\GuestStars;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\GuestStar;

/**
 * Class GuestStarFactory.
 *
 * @extends PeopleFactory<GuestStar>
 */
class GuestStarFactory extends PeopleFactory
{
    /**
     * @param CastMember|null $person
     */
    #[\Override]
    public function createCollection(array $data = [], $person = null, $collection = null): GuestStars
    {
        $collection = new GuestStars();

        $class = \is_object($person) ? $person::class : \Tmdb\Model\Person\GuestStar::class;

        foreach ($data as $item) {
            $collection->add(null, $this->create($item, new $class()));
        }

        return $collection;
    }
}
