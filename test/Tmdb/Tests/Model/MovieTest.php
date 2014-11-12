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

use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Movie;

class MovieTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructMovie()
    {
        $movie = new Movie();

        $this->assertInstancesOf(
            $movie,
            [
                /** Constructor */
                'getGenres'              => 'Tmdb\Model\Collection\Genres',
                'getProductionCompanies' => 'Tmdb\Model\Common\GenericCollection',
                'getProductionCountries' => 'Tmdb\Model\Common\GenericCollection',
                'getSpokenLanguages'     => 'Tmdb\Model\Common\GenericCollection',
                'getAlternativeTitles'   => 'Tmdb\Model\Common\GenericCollection',
                'getChanges'             => 'Tmdb\Model\Common\GenericCollection',
                'getCredits'             => 'Tmdb\Model\Collection\CreditsCollection',
                'getImages'              => 'Tmdb\Model\Collection\Images',
                'getKeywords'            => 'Tmdb\Model\Common\GenericCollection',
                'getLists'               => 'Tmdb\Model\Common\GenericCollection',
                'getReleases'            => 'Tmdb\Model\Common\GenericCollection',
                'getSimilar'             => 'Tmdb\Model\Common\GenericCollection',
                'getTranslations'        => 'Tmdb\Model\Common\GenericCollection',
                'getVideos'              => 'Tmdb\Model\Collection\Videos',
            ]
        );
    }

    /**
     * @test
     */
    public function shouldAllowOverridingDefaultCollectionObjects()
    {
        $movie = new Movie();

        $class     = new ResultCollection();
        $className = get_class($class);

        $movie->setChanges($class);
        $movie->setProductionCompanies($class);
        $movie->setProductionCountries($class);
        $movie->setSpokenLanguages($class);
        $movie->setCredits(new CreditsCollection());
        $movie->setLists($class);
        $movie->setVideos($class);

        $this->assertInstancesOf(
            $movie,
            [
                /** Constructor */
                'getChanges'             => $className,
                'getProductionCompanies' => $className,
                'getProductionCountries' => $className,
                'getSpokenLanguages'     => $className,
                'getCredits'             => 'Tmdb\Model\Collection\CreditsCollection',
                'getLists'               => $className,
                'getVideos'              => $className,
            ]
        );
    }
}
