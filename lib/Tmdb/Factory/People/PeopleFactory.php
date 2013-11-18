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

use Symfony\Component\Yaml\Exception\RuntimeException;
use Tmdb\Client;
use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Common\Collection;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;

class PeopleFactory extends AbstractFactory {
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        $person = null;

        if (array_key_exists('character', $data)) {
            $person = new CastMember();
        }

        if (array_key_exists('job', $data)) {
            $person = new CrewMember();
        }

        if (null === $person) {
            throw new RuntimeException(sprintf(
                'Was unable to determine the type of person by the data provided for #%d', $data['id']
            ));
        }

        return parent::hydrate($person, $data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollection(array $data = array())
    {
        $collection = new Collection();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }
}