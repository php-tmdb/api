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
    /**
     * @var Season
     */
    private $season;

    public function setUp()
    {
        /**
         * @var TvSeasonFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('tv/season/all.json');

        /**
         * @var Season $this->season
         */
        $this->season = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructTvSeason()
    {
        $this->assertInstanceOf('Tmdb\Model\Tv\Season', $this->season);

        $this->assertInstanceOf('\DateTime', $this->season->getAirDate());

        $this->assertInstanceOf('Tmdb\Model\Collection\Credits', $this->season->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Tv\ExternalIds', $this->season->getExternalIds());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->season->getImages());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->season->getEpisodes());
        $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $this->season->getPoster());
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