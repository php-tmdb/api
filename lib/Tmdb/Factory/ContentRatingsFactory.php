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
namespace Tmdb\Factory;

use Tmdb\Model\Collection\ContentRatings;
use Tmdb\Model\Tv\ContentRating;

/**
 * Class ContentRatingsFactory
 * @package Tmdb\Factory
 */
class ContentRatingsFactory extends AbstractFactory
{
    /**
     * @param array $data
     *
     * @return ContentRating
     */
    public function create(array $data = [])
    {
        return $this->hydrate(new ContentRating(), $data);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = [])
    {
        $collection = new ContentRatings();

        if (array_key_exists('results', $data)) {
            $results = $data['results'];
        }

        foreach ($results as $item) {
           $item['id'] = $data['id'];
            $collection->addContentRating(new \Tmdb\Model\Tv\ContentRating($item));
        }

        return $collection;
    }
}
