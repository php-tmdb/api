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

namespace Tmdb\Factory\Movie;

use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Common\Collection;
use Tmdb\Model\Movie\AlternativeTitle;

class AlternativeTitleFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        $title = new AlternativeTitle();

        return $title->hydrate($data);
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