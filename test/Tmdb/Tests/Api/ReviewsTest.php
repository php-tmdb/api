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
namespace Tmdb\Tests\Api;

class ReviewsTest extends TestCase
{
    const REVIEW_ID = '5013bc76760ee372cb00253e';

    /**
     * @test
     */
    public function shouldGetPerson()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/review/' . self::REVIEW_ID));

        $api->getReview(self::REVIEW_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Reviews';
    }
}
