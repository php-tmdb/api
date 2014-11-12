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
namespace Tmdb\Tests\Model;

use Tmdb\Model\Tv;

class TvTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructMovie()
    {
        $tv = new Tv();

        $this->assertInstancesOf(
            $tv,
            [
//                'getCreatedBy'           => 'Tmdb\Model\Collection\Images',
//                'getEpisodeRuntime'      => 'Tmdb\Model\Common\GenericCollection',
                'getGenres'              => 'Tmdb\Model\Collection\Genres',
//                'getLanguages'           => 'Tmdb\Model\Common\GenericCollection',
                'getNetworks'            => 'Tmdb\Model\Common\GenericCollection',
                'getOriginCountry'       => 'Tmdb\Model\Common\GenericCollection',
                'getSeasons'             => 'Tmdb\Model\Common\GenericCollection',
                'getCredits'             => 'Tmdb\Model\Collection\CreditsCollection',
                'getExternalIds'         => 'Tmdb\Model\Common\ExternalIds',
                'getImages'              => 'Tmdb\Model\Collection\Images',
                'getTranslations'        => 'Tmdb\Model\Common\GenericCollection',
                'getVideos'              => 'Tmdb\Model\Collection\Videos',
            ]
        );
    }
}
