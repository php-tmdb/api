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

use Tmdb\Model\Network;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Tv\EpisodeGroup;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class TvEpisodeGroupFactory
 * @package Tmdb\Factory
 */
class TvEpisodeGroupFactory extends AbstractFactory
{

    /**
     * @var TvEpisodeGroupsFactory
     */
    private $tvEpisodeGroupsFactory;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->tvEpisodeGroupsFactory = new TvEpisodeGroupsFactory($httpClient);

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
     * @return EpisodeGroup|null
     */
    public function create(array $data = []): ?EpisodeGroup
    {
        if (!$data) {
            return null;
        }

        $episodeGroup = new EpisodeGroup();

        if (array_key_exists('network', $data) && !is_null($data['network'])) {
            $episodeGroup->setNetwork($this->hydrate(new Network(), $data['network']));
        }

        if (array_key_exists('groups', $data) && $data['groups'] !== null) {
            $episodeGroup->setGroups($this->tvEpisodeGroupsFactory->createCollection($data['groups']));
        }

        return $this->hydrate($episodeGroup, $data);
    }
}
