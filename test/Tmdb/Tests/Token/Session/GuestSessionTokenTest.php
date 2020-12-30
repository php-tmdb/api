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

class GuestSessionTokenTest extends \PHPUnit\Framework\TestCase
{
    public const SESSION_TOKEN = '80b2bf99520cd795ff54e31af97917bc9e3a7c8d';

    /**
     * @test
     */
    public function testSetGet()
    {
        $token  = new \Tmdb\Token\Session\SessionToken();
        $token->setToken(self::SESSION_TOKEN);
        $token->setExpiresAt('2014-12-04 22:51:19 UTC');
        $token->setSuccess(true);

        $this->assertEquals(self::SESSION_TOKEN, $token->getToken());
        $this->assertEquals('04-12-2014', $token->getExpiresAt()->format('d-m-Y'));
        $this->assertEquals(true, $token->getSuccess());
    }
}
