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
namespace Tmdb\Tests\Factory;

use Tmdb\Factory\AuthenticationFactory;

class AuthenticationFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateRequestToken()
    {
        /**
         * @var AuthenticationFactory $factory
         */
        $factory = $this->getFactory();

        $token = $factory->createRequestToken($this->loadByFile('authentication/request_token.json'));

        $this->assertEquals('09-02-2012', $token->getExpiresAt()->format('d-m-Y'));
        $this->assertEquals('641bf16c663db167c6cffcdff41126039d4445bf', $token->getToken());
        $this->assertEquals(true, $token->getSuccess());
    }

    /**
     * @test
     */
    public function shouldCreateSessionToken()
    {
        /**
         * @var AuthenticationFactory $factory
         */
        $factory = $this->getFactory();

        $token = $factory->createSessionToken($this->loadByFile('authentication/session_token.json'));

        $this->assertEquals('80b2bf99520cd795ff54e31af97917bc9e3a7c8c', $token->getToken());
        $this->assertEquals(true, $token->getSuccess());
    }

    /**
     * @test
     */
    public function shouldCreateGuestSessionToken()
    {
        /**
         * @var AuthenticationFactory $factory
         */
        $factory = $this->getFactory();

        $token = $factory->createGuestSessionToken($this->loadByFile('authentication/guest_session_token.json'));

        $this->assertEquals('04-12-2012', $token->getExpiresAt()->format('d-m-Y'));
        $this->assertEquals('0c550fd5da2fc3f321ab3bs9b60ca108', $token->getToken());
        $this->assertEquals(true, $token->getSuccess());
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function shouldThrowExceptionForCreate()
    {
        /**
         * @var AuthenticationFactory $factory
         */
        $factory = $this->getFactory();

        $factory->create([]);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function shouldThrowExceptionForCreateCollection()
    {
        /**
         * @var AuthenticationFactory $factory
         */
        $factory = $this->getFactory();

        $factory->createCollection([]);
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\AuthenticationFactory';
    }
}
