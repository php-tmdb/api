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
namespace Tmdb\Tests\Factory;

use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Model\Movie;
use Tmdb\Model\Person;

class PeopleFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructPerson()
    {
        /**
         * @var PeopleFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('person/get.json');

        /**
         * @var Person $person
         */
        $person = $factory->create($data);

        $this->assertInstanceOf('Tmdb\Model\Person', $person);

        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $person->getImages());
        $this->assertInstanceOf('Tmdb\Model\Image\ProfileImage', $person->getProfile());
    }

    /**
     * @test
     */
    public function shouldConstructCastAndCredits()
    {
        $data         = $this->loadByFile('movie/all.json');
        /**
         * @var MovieFactory $movieFactory
         */
        $movieFactory = new MovieFactory();

        /**
         * @var Movie $movie
         */
        $movie   = $movieFactory->create($data);
        $credits = $movie->getCredits();

        $this->assertInstanceOf('Tmdb\Model\Collection\Credits', $credits);

        $cast = $credits->getCast();
        $crew = $credits->getCrew();

        $this->assertInstanceOf('Tmdb\Model\Collection\People\Cast', $cast);
        $this->assertInstanceOf('Tmdb\Model\Collection\People\Crew', $crew);
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\PeopleFactory';
    }
}