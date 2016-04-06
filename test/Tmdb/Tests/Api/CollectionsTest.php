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

class CollectionsTest extends TestCase
{
    const COLLECTION_ID = 120;

    /**
     * @test
     */
    public function shouldGetCollection()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/collection/' . self::COLLECTION_ID));

        $api->getCollection(self::COLLECTION_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('https://api.themoviedb.org/3/collection/' . self::COLLECTION_ID . '/images'));

        $api->getImages(self::COLLECTION_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Collections';
    }
}
