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

namespace Tmdb\Tests\Token\Session;

class RequestTokenTest extends \PHPUnit\Framework\TestCase
{
    public const REQUEST_TOKEN = '641bf16c663db167c6cffcdff41126039d4445bf';

    /**
     * @test
     */
    public function testSetGet()
    {
        $token  = new \Tmdb\Token\Session\RequestToken();
        $token->setToken(self::REQUEST_TOKEN);
        $token->setExpiresAt('2012-02-09 19:50:25 UTC');
        $token->setSuccess(true);

        $this->assertEquals(self::REQUEST_TOKEN, $token->getToken());
        $this->assertInstanceOf('DateTime', $token->getExpiresAt());
        $this->assertEquals(true, $token->getSuccess());
        $this->assertEquals(self::REQUEST_TOKEN, (string) $token);
    }
}
