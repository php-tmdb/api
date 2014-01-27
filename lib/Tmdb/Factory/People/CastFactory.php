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

use Tmdb\Model\Collection\People\Cast;

class CastFactory extends PeopleFactory
{
    /**
     * {@inheritdoc}
     */
    public function create(array $data = array(), $person = null)
    {
        return parent::create($data, $person);
    }

    /**
     * {@inheritdoc}
     * @param \Tmdb\Model\Tv\Person\CastMember $person
     */
    public function createCollection(array $data = array(), $person = null)
    {
        $collection = new Cast();

        foreach($data as $item) {
            $collection->add(null, parent::create($item, $person));
        }

        return $collection;
    }
}
