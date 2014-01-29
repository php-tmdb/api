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

use Tmdb\Factory\TvFactory;
use Tmdb\Model\Tv;

class TvFactoryTest extends TestCase
{
    const TV_ID = 3572;

    /**
     * @test
     */
    public function shouldConstructTv()
    {
        /**
         * @var TvFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('tv/all.json');

        /**
         * @var Tv $tv
         */
        $tv = $factory->create($data);

        $this->assertInstanceOf('Tmdb\Model\Tv', $tv);

        $this->assertInstanceOf('\DateTime', $tv->getLastAirDate());
        $this->assertInstanceOf('Tmdb\Model\Image\BackdropImage', $tv->getBackdrop());
        $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $tv->getPoster());
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        $factory = new TvFactory();

        $class = new \stdClass();

        $factory->setCastFactory($class);
        $factory->setCrewFactory($class);
        $factory->setGenreFactory($class);
        $factory->setImageFactory($class);
        $factory->setTvSeasonFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getCastFactory());
        $this->assertInstanceOf('stdClass', $factory->getCrewFactory());
        $this->assertInstanceOf('stdClass', $factory->getGenreFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
        $this->assertInstanceOf('stdClass', $factory->getTvSeasonFactory());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TvFactory';
    }
}