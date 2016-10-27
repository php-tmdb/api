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
     * @var Person
     */
    private $person;

    public function setUp()
    {
        /**
         * @var PeopleFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('person/get.json');

        $data['biography'] = 'external';

        /**
         * @var Person $person
         */
        $this->person = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructPerson()
    {
        $this->assertInstanceOf('Tmdb\Model\Person', $this->person);

        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->person->getImages());
        $this->assertInstanceOf('Tmdb\Model\Image\ProfileImage', $this->person->getProfileImage());
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
        $movieFactory = new MovieFactory($this->getHttpClient());

        /**
         * @var Movie $movie
         */
        $movie   = $movieFactory->create($data);
        $credits = $movie->getCredits();

        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection', $credits);

        $cast = $credits->getCast();
        $crew = $credits->getCrew();

        $this->assertInstanceOf('Tmdb\Model\Collection\People\Cast', $cast);
        $this->assertInstanceOf('Tmdb\Model\Collection\People\Crew', $crew);
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetImageFactory()
    {
        $factory = $this->getFactory();

        $newFactory = new \stdClass();
        $factory->setImageFactory($newFactory);

        $this->assertInstanceOf('\stdClass', $factory->getImageFactory());
    }

    /**
     * @test
     */
    public function shouldBeAbleToDissectResults()
    {
        $factory = $this->getFactory();

        $data = ['results' => [
            ['id' => 1],
            ['id' => 2],
        ]];

        $collection = $factory->createCollection($data);

        $this->assertEquals(2, count($collection));
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $alsoKnownAs = $this->person->getAlsoKnownAs();

        $this->assertEquals(false, $this->person->getAdult());
        $this->assertEquals(true, empty($alsoKnownAs));
        $this->assertEquals('external', $this->person->getBiography());
        $this->assertInstanceOf('\DateTime', $this->person->getBirthday());
        $this->assertEquals(false, $this->person->getDeathday());
        $this->assertEquals('', $this->person->getHomepage());
        $this->assertEquals(33, $this->person->getId());
        $this->assertEquals(true, $this->person->isMale());
        $this->assertEquals(false, $this->person->isFemale());
        $this->assertEquals(false, $this->person->isUnknownGender());
        //@todo
        //$this->assertEquals('nm0000641', $this->person->getImdbId());
        $this->assertEquals('Gary Sinise', $this->person->getName());
        $this->assertEquals('Blue Island, Illinois, USA', $this->person->getPlaceOfBirth());
        //@todo
        //$this->assertEquals(1.99498054250796, $this->person->getPopularity());
        $this->assertInstanceOf('Tmdb\Model\Image\ProfileImage', $this->person->getProfileImage());
        $this->assertEquals('/h9YwlLHANaQzaTVkVwxnxLbvCY4.jpg', $this->person->getProfilePath());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->person->getImages());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->person->getChanges());
        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection\CombinedCredits', $this->person->getCombinedCredits());
        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection\MovieCredits', $this->person->getMovieCredits());
        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection\TvCredits', $this->person->getTvCredits());
    }

    /**
     * @test
     */
    public function shouldSetDeathDay()
    {
        $person = new Person();
        $person->setDeathday('2013-12-12');

        $this->assertInstanceOf('\DateTime', $person->getDeathday());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\PeopleFactory';
    }
}
