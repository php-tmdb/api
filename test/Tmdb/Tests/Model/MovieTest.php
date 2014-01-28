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

use Tmdb\Model\Movie;

class MovieTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructMovie()
    {
        $person = new Movie();

        $this->assertInstancesOf(
            $person,
            array(
                /** Constructor */
                'getGenres'              => 'Tmdb\Model\Collection\Genres',
                'getProductionCompanies' => 'Tmdb\Model\Common\GenericCollection',
                'getProductionCountries' => 'Tmdb\Model\Common\GenericCollection',
                'getSpokenLanguages'     => 'Tmdb\Model\Common\GenericCollection',
                'getAlternativeTitles'   => 'Tmdb\Model\Common\GenericCollection',
                'getChanges'             => 'Tmdb\Model\Common\GenericCollection',
                'getCredits'             => 'Tmdb\Model\Collection\Credits',
                'getImages'              => 'Tmdb\Model\Collection\Images',
                'getKeywords'            => 'Tmdb\Model\Common\GenericCollection',
                'getLists'               => 'Tmdb\Model\Common\GenericCollection',
                'getReleases'            => 'Tmdb\Model\Common\GenericCollection',
                'getSimilarMovies'       => 'Tmdb\Model\Common\GenericCollection',
                'getTrailers'            => 'Tmdb\Model\Common\GenericCollection',
                'getTranslations'        => 'Tmdb\Model\Common\GenericCollection',
            )
        );
    }
}