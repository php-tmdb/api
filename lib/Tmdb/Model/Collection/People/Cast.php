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

namespace Tmdb\Model\Collection\People;

use Tmdb\Model\Collection\People;
use Tmdb\Model\Person;
use Tmdb\Model\Person\CastMember;

/**
 * Class Cast
 * @extends People<CastMember>
 * @package Tmdb\Model\Collection\People
 */
class Cast extends People
{
    /**
     * Returns all people
     *
     * @return CastMember[]
     */
    public function getCast()
    {
        return parent::getPeople();
    }

    /**
     * Retrieve a cast member from the collection
     *
     * @param $id
     *
     * @return ?CastMember
     */
    public function getCastMember($id): ?CastMember
    {
        return parent::getPerson($id);
    }
}
