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
namespace Tmdb\Tests;

class ApiTokenTest extends \PHPUnit_Framework_TestCase
{
    const API_TOKEN = 'abcdefg';

    /**
     * @test
     */
    public function testSetGet()
    {
        $token  = new \Tmdb\ApiToken();
        $token->setToken(self::API_TOKEN);

        $this->assertEquals(self::API_TOKEN, $token->getToken());
        $this->assertEquals(self::API_TOKEN, (string) $token);
    }

    /**
     * @expectedException Tmdb\Exception\RuntimeException
     * @test
     */
    public function testThrowsErrorOnEmptyApiToken()
    {
        $token  = new \Tmdb\ApiToken();
        $token->setToken(null);
    }
}
