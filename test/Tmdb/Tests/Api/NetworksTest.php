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

class NetworksTest extends TestCase
{
    public const NETWORK_ID = 49;

    /**
     * @test
     */
    public function shouldGetCredit()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getNetwork(self::NETWORK_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/network/' . self::NETWORK_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Networks';
    }
}
