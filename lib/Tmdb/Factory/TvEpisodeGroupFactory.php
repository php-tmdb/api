<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author sheriffmarley
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Factory;

use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Network;
use Tmdb\Model\Tv\EpisodeGroup;

/**
 * Class TvEpisodeGroupFactory.
 */
class TvEpisodeGroupFactory extends AbstractFactory
{
    private readonly \Tmdb\Factory\TvEpisodeGroupsFactory $tvEpisodeGroupsFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->tvEpisodeGroupsFactory = new TvEpisodeGroupsFactory($httpClient);

        parent::__construct($httpClient);
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
    public function create(array $data = []): ?EpisodeGroup
    {
        if ($data === []) {
            return null;
        }

        $episodeGroup = new EpisodeGroup();

        if (\array_key_exists('network', $data) && !\is_null($data['network'])) {
            $episodeGroup->setNetwork($this->hydrate(new Network(), $data['network']));
        }

        if (\array_key_exists('groups', $data) && null !== $data['groups']) {
            $episodeGroup->setGroups($this->tvEpisodeGroupsFactory->createCollection($data['groups']));
        }

        return $this->hydrate($episodeGroup, $data);
    }
}
