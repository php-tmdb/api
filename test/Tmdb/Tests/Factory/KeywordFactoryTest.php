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

use Tmdb\Factory\KeywordFactory;

class KeywordFactoryTest extends TestCase
{
    private $data;

    public function setUp() :void
    {
        $this->data = $this->loadByFile('keywords/get.json');
    }

    /**
     * @test
     */
    public function shouldConstructKeyword()
    {
        /**
         * @var KeywordFactory $factory
         */
        $factory = $this->getFactory();
        $keyword = $factory->create($this->data);

        $this->assertInstanceOf('Tmdb\Model\Keyword', $keyword);
        $this->assertEquals(1721, $keyword->getId());
        $this->assertEquals('fight', $keyword->getName());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\KeywordFactory';
    }
}
