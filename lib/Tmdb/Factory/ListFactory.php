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

use Tmdb\Factory\Lists\ListItemFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Lists;

/**
 * Class ListFactory.
 */
class ListFactory extends AbstractFactory
{
    /**
     * @var ImageFactory|mixed
     */
    private $imageFactory;

    /**
     * @var ListItemFactory|mixed
     */
    private $listItemFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->imageFactory = new ImageFactory($httpClient);
        $this->listItemFactory = new ListItemFactory($httpClient);

        parent::__construct($httpClient);
    }

    /**
     * @return Lists\ItemStatus
     */
    public function createItemStatus(array $data = [])
    {
        return $this->hydrate(new Lists\ItemStatus(), $data);
    }

    /**
     * @return Lists\Result
     */
    #[\Override]
    public function createResult(array $data = [])
    {
        return $this->hydrate(new Lists\Result(), $data);
    }

    /**
     * @return Lists\ResultWithListId
     */
    public function createResultWithListId(array $data = [])
    {
        return $this->hydrate(new Lists\ResultWithListId(), $data);
    }

    #[\Override]
    public function createCollection(array $data = []): GenericCollection
    {
        $collection = new GenericCollection();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): Lists
    {
        $lists = new Lists();

        if (\array_key_exists('items', $data)) {
            $lists->setItems(
                $this->getListItemFactory()->createCollection($data['items']),
            );
        }

        /* Images */
        if (\array_key_exists('poster_path', $data)) {
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
     */
    public function setListItemFactory($listItemFactory): static
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
     */
    public function setImageFactory($imageFactory): static
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }
}
