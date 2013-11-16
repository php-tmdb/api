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
namespace Tmdb\Factory\People;

use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Collection\People\Crew;
use Tmdb\Model\Collection\People;

class CrewFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        $crew = new Crew();

        return $crew->hydrate($data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollection(array $data = array())
    {
        $collection = new People();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }
}