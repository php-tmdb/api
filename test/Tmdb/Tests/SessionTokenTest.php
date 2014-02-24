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
class SessionTokenTest extends \PHPUnit_Framework_TestCase
{
    const SESSION_TOKEN = '80b2bf99520cd795ff54e31af97917bc9e3a7c8c';

    /**
     * @test
     */
    public function testSetGet()
    {
        $token  = new \Tmdb\SessionToken();
        $token->setToken(self::SESSION_TOKEN);

        $this->assertEquals(self::SESSION_TOKEN, $token->getToken());
    }
}
