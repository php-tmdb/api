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

namespace Tmdb\Factory\Common;

use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\Video;

/**
 * Class VideoFactory.
 *
 * @extends AbstractFactory<Video>
 */
class VideoFactory extends AbstractFactory
{
    #[\Override]
    public function createCollection(array $data = []): Videos
    {
        $collection = new Videos();

        if (\array_key_exists('videos', $data)) {
            $data = $data['videos'];
        }

        if (\array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): ?Video
    {
        $videoType = $this->resolveVideoType($data);

        return (null === $videoType) ? null : $this->hydrate($videoType, $data);
    }

    private function resolveVideoType(array $data): \Tmdb\Model\Common\Video\Youtube|\Tmdb\Model\Common\Video|null
    {
        if (\array_key_exists('site', $data) && !empty($data['site'])) {
            $site = strtolower((string) $data['site']);

            return match ($site) {
                'youtube' => new Video\Youtube(),
                default => new Video(),
            };
        }

        return null;
    }
}
