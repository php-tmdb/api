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

class KeywordsTest extends TestCase
{
    const KEYWORD_ID = 1712;

    /**
     * @test
     */
    public function shouldGetKeyword()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('keyword/' . self::KEYWORD_ID));

        $api->getKeyword(self::KEYWORD_ID);
    }

    /**
     * @test
     */
    public function shouldGetMovies()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('keyword/' . self::KEYWORD_ID . '/movies'));

        $api->getMovies(self::KEYWORD_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Keywords';
    }
}
