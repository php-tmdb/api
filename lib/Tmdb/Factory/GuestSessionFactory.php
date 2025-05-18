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

use Tmdb\Exception\NotImplementedException;

/**
 * Currently a place-holder for future expansions.
 *
 * Class GuestSessionFactory
 */
class GuestSessionFactory extends AbstractFactory
{
    /**
     * @throws NotImplementedException
     */
    #[\Override]
    public function create(array $data = []): void
    {
        throw new NotImplementedException('GuestSessionFactory does not implement create.');
    }

    /**
     * @throws NotImplementedException
     */
    #[\Override]
    public function createCollection(array $data = []): void
    {
        throw new NotImplementedException('GuestSessionFactory does not implement createCollection.');
    }
}
