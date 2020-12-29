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
 * @version 4.0.0
 */

namespace Tmdb\Tests\Api;

class CollectionsTest extends TestCase
{
    public const COLLECTION_ID = 120;

    /**
     * @test
     */
    public function shouldGetCollection()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCollection(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTranslations(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID . '/translations');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Collections';
    }
}
