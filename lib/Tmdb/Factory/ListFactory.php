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

use Tmdb\Factory\Lists\ListItemFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Genre;
use Tmdb\Model\Lists;

/**
 * Class ListFactory
 * @package Tmdb\Factory
 */
class ListFactory extends AbstractFactory
{
    /**
     * @var ImageFactory
     */
    private $imageFactory;

    /**
     * @var ListItemFactory
     */
    private $listItemFactory;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->imageFactory = new ImageFactory($httpClient);
        $this->listItemFactory = new ListItemFactory($httpClient);

        parent::__construct($httpClient);
    }

    /**
     * @param array $data
     *
     * @return Lists\ItemStatus
     */
    public function createItemStatus(array $data = [])
    {
        return $this->hydrate(new Lists\ItemStatus(), $data);
    }

    /**
     * @param array $data
     *
     * @return Lists\Result
     */
    public function createResult(array $data = [])
    {
        return $this->hydrate(new Lists\Result(), $data);
    }

    /**
     * @param array $data
     *
     * @return Lists\ResultWithListId
     */
    public function createResultWithListId(array $data = [])
    {
        return $this->hydrate(new Lists\ResultWithListId(), $data);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = []): GenericCollection
    {
        $collection = new GenericCollection();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    /**
     * @param array $data
     *
     * @return Lists
     */
    public function create(array $data = []): Lists
    {
        $lists = new Lists();

        if (array_key_exists('items', $data)) {
            $lists->setItems(
                $this->getListItemFactory()->createCollection($data['items'])
            );
        }

        /** Images */
        if (array_key_exists('poster_path', $data)) {
            $lists->setPosterImage($this->getImageFactory()->createFromPath($data['poster_path'], 'poster_path'));
        }

        return $this->hydrate($lists, $data);
    }

    /**
     * @return ListItemFactory
     */
    public function getListItemFactory()
    {
        return $this->listItemFactory;
    }

    /**
     * @param ListItemFactory $listItemFactory
     * @return self
     */
    public function setListItemFactory($listItemFactory)
    {
        $this->listItemFactory = $listItemFactory;

        return $this;
    }

    /**
     * @return ImageFactory
     */
    public function getImageFactory()
    {
        return $this->imageFactory;
    }

    /**
     * @param ImageFactory $imageFactory
     * @return self
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }
}
