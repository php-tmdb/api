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

namespace Tmdb\Tests\Token\Api;

use Tmdb\Exception\RuntimeException;

class ApiTokenTest extends \PHPUnit\Framework\TestCase
{
    public const API_TOKEN = 'abcdefg';

    /**
     * @test
     */
    public function testSetGet()
    {
        $token  = new \Tmdb\Token\Api\ApiToken();
        $token->setToken(self::API_TOKEN);

        $this->assertEquals(self::API_TOKEN, $token->getToken());
        $this->assertEquals(self::API_TOKEN, (string) $token);
    }

    /**
     * @test
     */
    public function testThrowsErrorOnEmptyApiToken()
    {
        $this->expectException(RuntimeException::class);
        $token  = new \Tmdb\Token\Api\ApiToken();
        $token->setToken(null);
    }
}
