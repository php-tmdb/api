<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author sheriffmarley
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\Factory;

use Tmdb\Model\AbstractModel;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Tv\TvEpisodeGroup;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class TvEpisodeGroupsFactory
 * @package Tmdb\Factory
 */
class TvEpisodeGroupsFactory extends AbstractFactory
{

    /**
     * @var TvEpisodeFactory
     */
    private $tvEpisodeFactory;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->tvEpisodeFactory = new TvEpisodeFactory($httpClient);

        parent::__construct($httpClient);
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
     * {@inheritdoc}
     *
     * @return TvEpisodeGroup|null
     */
    public function create(array $data = []): ?TvEpisodeGroup
    {
        if (!$data) {
            return null;
        }

        $tvEpisodeGroup = new TvEpisodeGroup();

        /** Episodes */
        if (array_key_exists('episodes', $data) && $data['episodes'] !== null) {
            $tvEpisodeGroup->setEpisodes($this->getTvEpisodeFactory()->createCollection($data['episodes']));
        }

        return $this->hydrate($tvEpisodeGroup, $data);
    }

    /**
     * @return TvEpisodeFactory
     */
    public function getTvEpisodeFactory()
    {
        return $this->tvEpisodeFactory;
    }

    /**
     * @param TvEpisodeFactory $tvEpisodeFactory
     * @return self
     */
    public function setTvEpisodeFactory($tvEpisodeFactory)
    {
        $this->tvEpisodeFactory = $tvEpisodeFactory;

        return $this;
    }
}
