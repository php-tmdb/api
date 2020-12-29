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

namespace Tmdb\Tests\Model\Tv;

use stdClass;
use Tmdb\Model\Tv\Episode;
use Tmdb\Tests\Model\TestCase;

class EpisodeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructTvEpisode()
    {
        $episode = new Episode();

        $this->assertInstancesOf(
            $episode,
            [
                'getCredits' => 'Tmdb\Model\Collection\CreditsCollection',
                'getExternalIds' => 'Tmdb\Model\Common\ExternalIds',
                'getImages' => 'Tmdb\Model\Collection\Images',
                'getVideos' => 'Tmdb\Model\Collection\Videos',
            ]
        );
    }

    /**
     * @test
     */
    public function shouldBeAbleToOverrideDefaultCollections()
    {
        $episode = new Episode();

        $class = new stdClass();

        $episode->setCredits($class);

        $this->assertInstanceOf('stdClass', $episode->getCredits());
    }
}
