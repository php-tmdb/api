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

use Tmdb\Model\Find;

class FindFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructFind()
    {
        $factory = $this->getFactory();

        /**
         * @var Find $find
         */
        $find = $factory->create([
            'movie_results'  => [['id' => 1]],
            'person_results' => [['id' => 1]],
            'tv_results'     => [['id' => 1]],
        ]);

        $this->assertInstanceOf('Tmdb\Model\Find', $find);

        foreach ($find->getMovieResults() as $movie) {
            $this->assertInstanceOf('Tmdb\Model\Movie', $movie);
        }

        foreach ($find->getPersonResults() as $person) {
            $this->assertInstanceOf('Tmdb\Model\Person', $person);
        }

        foreach ($find->getTvResults() as $tv) {
            $this->assertInstanceOf('Tmdb\Model\Tv', $tv);
        }
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setMovieFactory($class);
        $factory->setPeopleFactory($class);
        $factory->setTvFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getMovieFactory());
        $this->assertInstanceOf('stdClass', $factory->getPeopleFactory());
        $this->assertInstanceOf('stdClass', $factory->getTvFactory());
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function shouldThrowExceptionForCreateCollection()
    {
        $factory = $this->getFactory();
        $factory->createCollection([]);
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\FindFactory';
    }
}
