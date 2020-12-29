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

class CreditsTest extends TestCase
{
    public const CREDIT_ID = '5240760b5dbf5b0c2c0139db';

    /**
     * @test
     */
    public function shouldGetCredit()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredit(self::CREDIT_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/credit/' . self::CREDIT_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Credits';
    }
}
