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
     * @test
     */
    public function shouldConstructTvEpisode()
    {
        /**
         * @var TvEpisodeFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('tv/season/episode/all.json');

        /**
         * @var Episode $episode
         */
        $episode = $factory->create($data);

        $this->assertInstanceOf('Tmdb\Model\Tv\Episode', $episode);

        $this->assertInstanceOf('\DateTime', $episode->getAirDate());

        $this->assertInstanceOf('Tmdb\Model\Collection\Credits', $episode->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Tv\ExternalIds', $episode->getExternalIds());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $episode->getImages());
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

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TvEpisodeFactory';
    }
}