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

use Tmdb\Factory\ConfigurationFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Configuration;

class ConfigurationFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConstructConfiguration()
    {
        /**
         * @var ConfigurationFactory $factory
         */
        $factory = $this->getFactory();
        $data    = $this->loadByFile('configuration/get.json');

        /**
         * @var Configuration $configuration
         */
        $configuration = $factory->create($data);

        $this->assertInstanceOf('Tmdb\Model\Configuration', $configuration);

        $images = $configuration->getImages();
        $changeKeys = $configuration->getChangeKeys();

        $this->assertEquals(true, !empty($images));
        $this->assertEquals(true, !empty($changeKeys));
    }

    /**
     * @test
     */
    public function callingCollectionReturnsEmptyArray()
    {
        /**
         * @var ConfigurationFactory $factory
         */
        $factory = $this->getFactory();

        $this->assertEquals(new GenericCollection(), $factory->createCollection([]));
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\ConfigurationFactory';
    }
}
