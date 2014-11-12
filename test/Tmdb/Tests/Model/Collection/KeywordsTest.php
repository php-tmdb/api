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
namespace Tmdb\Tests\Model\Collection;

use Tmdb\Model\Collection\Keywords;
use Tmdb\Model\Keyword;
use Tmdb\Tests\Model\TestCase;

class KeywordsTest extends TestCase
{
    /**
     * @var Keywords
     */
    private $collection;

    private $keywords = [
        ['id' => 1, 'name' => 'dark'],
        ['id' => 2, 'name' => 'light']
    ];

    public function setUp()
    {
        $this->collection = new Keywords();

        foreach ($this->keywords as $keyword) {
            $object = $this->hydrate(new Keyword(), $keyword);

            $this->collection->addKeyword($object);
        }
    }

    /**
     * @test
     */
    public function shouldGetAndSet()
    {
        $this->assertEquals(count($this->keywords), count($this->collection->getKeywords()));

        $this->assertEquals('dark', $this->collection->getKeyword(1)->getName());
        $this->assertEquals(null, $this->collection->getKeyword(3));
    }
}
