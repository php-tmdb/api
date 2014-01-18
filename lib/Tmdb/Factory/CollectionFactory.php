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

class CollectionFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     * @return \Tmdb\Model\Collection
     */
    public static function create(array $data = array())
    {
        $collection = new \Tmdb\Model\Collection();

        if (array_key_exists('parts', $data)) {
            $collection->setParts(
                MovieFactory::createCollection($data['parts'])
            );
        }

        if (array_key_exists('backdrop_path', $data)) {
            $collection->setBackdrop(ImageFactory::createFromPath($data['backdrop_path'], 'backdrop_path'));
        }

        if (array_key_exists('images', $data)) {
            $collection->setImages(ImageFactory::createCollectionFromMovie($data['images']));
        }

        if (array_key_exists('poster_path', $data)) {
            $collection->setPoster(ImageFactory::createFromPath($data['poster_path'], 'poster_path'));
        }

        return parent::hydrate($collection, $data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollection(array $data = array())
    {
        $collection = new \Tmdb\Model\Common\Collection();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }
}