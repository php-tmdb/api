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

use Tmdb\Factory\ReviewFactory;
use Tmdb\Model\Review;

class ReviewFactoryTest extends TestCase
{
    private $data;

    public function setUp() :void
    {
        $this->data = $this->loadByFile('reviews/get.json');
    }

    /**
     * @test
     */
    public function shouldConstructReview()
    {
        /**
         * @var ReviewFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var Review $review
         */
        $review = $factory->create($this->data);

        $review->setContent('content-test');

        $this->assertInstanceOf('Tmdb\Model\Review', $review);
        $this->assertEquals('5013bc76760ee372cb00253e', $review->getId());
        $this->assertEquals('Chris', $review->getAuthor());
        $this->assertEquals('content-test', $review->getContent());
        $this->assertEquals('en', $review->getIso6391());
        $this->assertEquals(49026, $review->getMediaId());
        $this->assertEquals('The Dark Knight Rises', $review->getMediaTitle());
        $this->assertEquals('Movie', $review->getMediaType());
        $this->assertEquals('http://j.mp/P18dg1', $review->getUrl());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\ReviewFactory';
    }
}
