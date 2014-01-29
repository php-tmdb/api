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

use Tmdb\Factory\TvSeasonFactory;
use Tmdb\Model\Tv\Season;

class TvSeasonFactoryTest extends TestCase
{
    const TV_ID = 3572;

    /**
     * @test
     */
    public function shouldConstructTv()
    {
        /**
         * @var TvSeasonFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('tv/season/all.json');

        /**
         * @var Season $season
         */
        $season = $factory->create($data);

        $this->assertInstanceOf('Tmdb\Model\Tv\Season', $season);

        $this->assertInstanceOf('\DateTime', $season->getAirDate());

        $this->assertInstanceOf('Tmdb\Model\Collection\Credits', $season->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Collection\Credits', $season->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Tv\ExternalIds', $season->getExternalIds());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $season->getImages());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $season->getEpisodes());
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var TvSeasonFactory $factory
         */
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setCastFactory($class);
        $factory->setCrewFactory($class);
        $factory->setImageFactory($class);
        $factory->setTvEpisodeFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getCastFactory());
        $this->assertInstanceOf('stdClass', $factory->getCrewFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
        $this->assertInstanceOf('stdClass', $factory->getTvEpisodeFactory());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TvSeasonFactory';
    }
}