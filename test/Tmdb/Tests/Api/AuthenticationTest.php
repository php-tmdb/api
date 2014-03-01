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

class AuthenticationTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetNewToken()
    {
        $api = $this->getApiMock();
        $api->getNewToken();
    }

    /**
     * @test
     */
    public function shouldGetNewSession()
    {
        $api = $this->getApiMock();
        $api->getNewSession('request_token');
    }

    /**
     * @test
     */
    public function shouldGetNewGuestSession()
    {
        $api = $this->getApiMock();
        $api->getNewGuestSession();
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Authentication';
    }
}
