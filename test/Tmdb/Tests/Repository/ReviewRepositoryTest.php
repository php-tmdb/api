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
namespace Tmdb\Tests\Repository;

class ReviewRepositoryTest extends TestCase
{
    const REVIEW_ID = '5013bc76760ee372cb00253e';

    /**
     * @test
     */
    public function shouldLoadReview()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::REVIEW_ID);
    }

    /**
     * @test
     */
    public function shouldGetReviews()
    {
        $repository = $this->getRepositoryWithMockedHttpClient();

        $repository->load(self::REVIEW_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Review';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\ReviewRepository';
    }
}
