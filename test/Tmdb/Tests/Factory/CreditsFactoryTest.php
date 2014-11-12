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

use Tmdb\Factory\CreditsFactory;
use Tmdb\Model\Credits;

class CreditsFactoryTest extends TestCase
{
    private $data;

    /**
     * @var \Tmdb\Model\Credits
     */
    private $credits;

    public function setUp()
    {
        $this->data = $this->loadByFile('credits/get.json');

        /**
         * @var CreditsFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var Credits $credits
         */
        $this->credits = $factory->create($this->data);
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var CreditsFactory $factory
         */
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setPeopleFactory($class);
        $factory->setTvEpisodeFactory($class);
        $factory->setTvSeasonFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getPeopleFactory());
        $this->assertInstanceOf('stdClass', $factory->getTvEpisodeFactory());
        $this->assertInstanceOf('stdClass', $factory->getTvSeasonFactory());
    }

    /**
     * @test
     * @expectedException Tmdb\Exception\NotImplementedException
     */
    public function shouldThrowExceptionForCollection()
    {
        $factory = $this->getFactory();

        $factory->createCollection([]);
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        /**
         * @var CreditsFactory $factory
         */
        $factory                 = $this->getFactory();

        $this->assertInstanceOf('Tmdb\Model\Credits', $this->credits);

        $this->assertEquals('cast', $this->credits->getCreditType());
        $this->assertEquals('Actors', $this->credits->getDepartment());
        $this->assertEquals('Actor', $this->credits->getJob());

        $this->assertInstanceOf('Tmdb\Model\Credits\Media', $this->credits->getMedia());
        $this->assertEquals(5, $this->credits->getMedia()->getId());
        $this->assertEquals('Seinfeld', $this->credits->getMedia()->getName());
        $this->assertEquals('Seinfeld', $this->credits->getMedia()->getOriginalName());
        $this->assertEquals('', $this->credits->getMedia()->getCharacter());

        $this->assertEquals('tv', $this->credits->getMediaType());
        $this->assertEquals('5240760b5dbf5b0c2c0139db', $this->credits->getId());

        $this->assertInstanceOf('Tmdb\Model\Person', $this->credits->getPerson());
        $this->assertEquals('Bryan Cranston', $this->credits->getPerson()->getName());
        $this->assertEquals(17419, $this->credits->getPerson()->getId());
    }

    /**
     * @test
     */
    public function shouldCreateCollection()
    {
        $this->assertEquals(true, !empty($this->credits));
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\CreditsFactory';
    }
}
