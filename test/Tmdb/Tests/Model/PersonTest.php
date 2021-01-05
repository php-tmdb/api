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

namespace Tmdb\Tests\Model;

use Http\Mock\Client;
use stdClass;
use Tmdb\Common\ObjectHydrator;
use Tmdb\Factory\PeopleFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Person;

class PersonTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructPersons()
    {
        $person = new Person();

        $this->assertInstancesOf(
            $person,
            [
                'getImages' => 'Tmdb\Model\Collection\Images',
                'getChanges' => 'Tmdb\Model\Common\GenericCollection',
                'getCombinedCredits' => 'Tmdb\Model\Collection\CreditsCollection\CombinedCredits',
                'getMovieCredits' => 'Tmdb\Model\Collection\CreditsCollection\MovieCredits',
                'getTvCredits' => 'Tmdb\Model\Collection\CreditsCollection\TvCredits',
            ]
        );
    }

    /**
     * @test
     */
    public function shouldBeAbleToReplaceCollections()
    {
        $factory = new Person();
        $class = new stdClass();

        $factory->setCombinedCredits($class);
        $factory->setMovieCredits($class);
        $factory->setTvCredits($class);

        $this->assertInstanceOf('stdClass', $factory->getCombinedCredits());
        $this->assertInstanceOf('stdClass', $factory->getMovieCredits());
        $this->assertInstanceOf('stdClass', $factory->getTvCredits());
    }

    /**
     * @test
     */
    public function shouldAllowOverridingDefaultCollectionObjects()
    {
        $movie = new Person();

        $class = new GenericCollection();
        $className = get_class($class);

        $movie->setChanges($class);

        $this->assertInstancesOf(
            $movie,
            [
                /** Constructor */
                'getChanges' => $className
            ]
        );
    }

    /**
     * @test
     */
    public function regressionIssue180()
    {
        $person = (new ObjectHydrator())->hydrate(new Person(), [
            'birthday' => '1945',
            'deathday' => '1946',
        ]);

        $actualBirthDate = $person->getBirthday()->format('Y-m-d');
        $actualDeathDate = $person->getDeathday()->format('Y-m-d');

        $this->assertEquals('1945-01-01', $actualBirthDate);
        $this->assertEquals('1946-01-01', $actualDeathDate);
    }
}
