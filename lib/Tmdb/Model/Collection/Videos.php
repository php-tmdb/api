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

namespace Tmdb\Model\Collection;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Video;

/**
 * Class Videos.
 *
 * @extends GenericCollection<Video>
 */
class Videos extends GenericCollection
{
    /**
     * Returns all videos.
     *
     * @return array
     */
    public function getVideos()
    {
        return $this->data;
    }

    /**
     * Retrieve a video from the collection.
     */
    public function getVideo($id): ?Video
    {
        return $this->filterId($id);
    }

    /**
     * Add a video to the collection.
     */
    public function addVideo(Video $video): void
    {
        $this->add(null, $video);
    }
}
