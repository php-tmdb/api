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

use PHPUnit\Framework\Attributes\Test;

class CollectionsTest extends TestCase
{
    public const COLLECTION_ID = 120;

    /**
     * */
    #[Test]
    public function shouldGetCollection()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCollection(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID);
    }

    /**
     * */
    #[Test]
    public function shouldGetImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID . '/images');
    }

    /**
     * */
    #[Test]
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
