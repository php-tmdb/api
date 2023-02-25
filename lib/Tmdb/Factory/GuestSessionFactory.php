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

use Tmdb\Exception\NotImplementedException;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;

/**
 * Currently a place-holder for future expansions
 *
 * Class GuestSessionFactory
 * @package Tmdb\Factory
 */
class GuestSessionFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     *
     * @throws NotImplementedException
     */
    public function create(array $data = [])
    {
        throw new NotImplementedException('GuestSessionFactory does not implement create.');
    }

    /**
     * {@inheritdoc}
     *
     * @throws NotImplementedException
     */
    public function createCollection(array $data = [])
    {
        throw new NotImplementedException('GuestSessionFactory does not implement createCollection.');
    }
}
