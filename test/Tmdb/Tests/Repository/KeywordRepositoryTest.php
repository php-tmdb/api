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

use Tmdb\Repository\KeywordRepository;

class KeywordRepositoryTest extends TestCase
{
    public const KEYWORD_ID = 1721;

    /**
     * @test
     */
    public function shouldLoadKeyword()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::KEYWORD_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/keyword/' . self::KEYWORD_ID);
    }

    /**
     * @test
     */
    public function shouldGetKeywordsForMovie()
    {
        /**
         * @var KeywordRepository $repository
         */
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->getMovies(self::KEYWORD_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/keyword/' . self::KEYWORD_ID . '/movies');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Keyword';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\KeywordRepository';
    }
}
