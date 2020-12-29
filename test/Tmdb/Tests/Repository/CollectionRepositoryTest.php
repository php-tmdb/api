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

namespace Tmdb\Tests\Repository;

use Tmdb\Repository\CollectionRepository;

class CollectionRepositoryTest extends TestCase
{
    public const COLLECTION_ID = 120;

    /**
     * @test
     */
    public function shouldLoadCollection()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID);
        $this->assertRequestHasQueryParameters([
            'append_to_response' => 'images,translations'
                                               ]);
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getImages(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getTranslations(self::COLLECTION_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/collection/' . self::COLLECTION_ID . '/translations');
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var CollectionRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpClient();
        $class      = new \stdClass();

        $repository->setImageFactory($class);

        $this->assertInstanceOf('stdClass', $repository->getImageFactory());
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Collections';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\CollectionRepository';
    }
}
