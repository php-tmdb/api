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

use Tmdb\Factory\TvEpisodeFactory;
use Tmdb\Model\Tv\Episode;

class TvEpisodeFactoryTest extends TestCase
{
    /**
     * @var Episode
     */
    private $episode;

    public function setUp() :void
    {
        /**
         * @var TvEpisodeFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('tv/season/episode/all.json');

        /**
         * @var Episode $episode
         */
        $this->episode = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructTvEpisode()
    {
        $this->assertInstanceOf('Tmdb\Model\Tv\Episode', $this->episode);

        $this->assertInstanceOf('\DateTime', $this->episode->getAirDate());

        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection', $this->episode->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Common\ExternalIds', $this->episode->getExternalIds());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->episode->getImages());
        $this->assertInstanceOf('Tmdb\Model\Image\StillImage', $this->episode->getStillImage());
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var TvEpisodeFactory $factory
         */
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setCastFactory($class);
        $factory->setCrewFactory($class);
        $factory->setImageFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getCastFactory());
        $this->assertInstanceOf('stdClass', $factory->getCrewFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $this->assertEquals(new \DateTime('2009-03-08'), $this->episode->getAirDate());
        $this->assertEquals(1, $this->episode->getEpisodeNumber());
        $this->assertEquals('Seven Thirty-Seven', $this->episode->getName());
        $this->assertEquals('Walt and Jesse try to figure a way out of their partnership with Tuco. Hank tries to mend the fences between Marie and Skyler.', $this->episode->getOverview());
        $this->assertEquals(62092, $this->episode->getId());
        $this->assertEquals(null, $this->episode->getProductionCode());
        $this->assertEquals(2, $this->episode->getSeasonNumber());
        $this->assertEquals('/bwgioLAgihPCUK21rLWocDaDM3g.jpg', $this->episode->getStillPath());
        $this->assertEquals(0, $this->episode->getVoteAverage());
        $this->assertEquals(0, $this->episode->getVoteCount());

    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TvEpisodeFactory';
    }
}
