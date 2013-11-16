<?php
/**
 * This file is part of the Wrike PHP API created by B-Found IM&S.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @package Wrike
 * @author Michael Roterman <michael@b-found.nl>
 * @copyright (c) 2013, B-Found Internet Marketing & Services
 * @version 0.0.1
 */

namespace Tmdb\Factory\People;

use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Collection\People\Cast;
use Tmdb\Model\Collection\People;

class CastFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        $cast = new Cast();

        return $cast->hydrate($data);
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