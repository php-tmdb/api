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
use Tmdb\Model\Tv\TvEpisodeGroup;

/**
 * Class TvEpisodeGroupsFactory.
 */
class TvEpisodeGroupsFactory extends AbstractFactory
{
    private \Tmdb\Factory\TvEpisodeFactory $tvEpisodeFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->tvEpisodeFactory = new TvEpisodeFactory($httpClient);

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
    public function create(array $data = []): ?TvEpisodeGroup
    {
        if ($data === []) {
            return null;
        }

        $tvEpisodeGroup = new TvEpisodeGroup();

        /* Episodes */
        if (\array_key_exists('episodes', $data) && null !== $data['episodes']) {
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
     */
    public function setTvEpisodeFactory($tvEpisodeFactory): static
    {
        $this->tvEpisodeFactory = $tvEpisodeFactory;

        return $this;
    }
}
