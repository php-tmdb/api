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

namespace Tmdb\Tests;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Client;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\SessionToken;

class ClientTest extends TestCase
{
    public const API_TOKEN = 'abcdef';
    public const SESSION_TOKEN = '80b2bf99520cd795ff54e31af97917bc9e3a7c8c';

    /**
     * @var Client
     */
    private $client = null;

    public function setUp(): void
    {
        $token = new ApiToken(self::API_TOKEN);
        $sessionToken = new GuestSessionToken(self::SESSION_TOKEN);
        $eventDispatcher = new EventDispatcher();

        $client = new Client(
            [
                'api_token' => $token,
                'guest_session_token' => $sessionToken,
                'event_dispatcher' => [
                    'adapter' => $eventDispatcher
                ]
            ]
        );

        $this->client = $client;
    }

    /**
     * @test
     */
    public function shouldNotHaveToPassHttpClientToConstructor()
    {
        $this->assertInstanceOf('Tmdb\HttpClient\HttpClient', $this->client->getHttpClient());
    }

    /**
     * @test
     */
    public function shouldContainGuestSessionToken()
    {
        $this->assertInstanceOf('Tmdb\Token\Session\GuestSessionToken', $this->client->getGuestSessionToken());
        $this->assertEquals(self::SESSION_TOKEN, $this->client->getGuestSessionToken()->getToken());
    }

    /**
     * @test
     */
    public function assertInstances()
    {
        $this->assertInstancesOf(
            $this->client,
            [
                'getAccountApi' => 'Tmdb\Api\Account',
                'getAuthenticationApi' => 'Tmdb\Api\Authentication',
                'getCertificationsApi' => 'Tmdb\Api\Certifications',
                'getChangesApi' => 'Tmdb\Api\Changes',
                'getCollectionsApi' => 'Tmdb\Api\Collections',
                'getCompaniesApi' => 'Tmdb\Api\Companies',
                'getConfigurationApi' => 'Tmdb\Api\Configuration',
                'getCreditsApi' => 'Tmdb\Api\Credits',
                'getDiscoverApi' => 'Tmdb\Api\Discover',
                'getFindApi' => 'Tmdb\Api\Find',
                'getGenresApi' => 'Tmdb\Api\Genres',
                'getGuestSessionApi' => 'Tmdb\Api\GuestSession',
                'getJobsApi' => 'Tmdb\Api\Jobs',
                'getKeywordsApi' => 'Tmdb\Api\Keywords',
                'getListsApi' => 'Tmdb\Api\Lists',
                'getMoviesApi' => 'Tmdb\Api\Movies',
                'getNetworksApi' => 'Tmdb\Api\Networks',
                'getPeopleApi' => 'Tmdb\Api\People',
                'getReviewsApi' => 'Tmdb\Api\Reviews',
                'getSearchApi' => 'Tmdb\Api\Search',
                'getTimezonesApi' => 'Tmdb\Api\Timezones',
                'getTvApi' => 'Tmdb\Api\Tv',
                'getTvSeasonApi' => 'Tmdb\Api\TvSeason',
                'getTvEpisodeApi' => 'Tmdb\Api\TvEpisode',
            ]
        );
    }

    /**
     * @test
     */
    public function shouldRespectSecureClientOption()
    {
        $client = new Client(
            [
                'api_token' => new ApiToken('test'),
                'event_dispatcher' => ['adapter' => new EventDispatcher()]
            ]
        );
        $options = $client->getOptions();
        $this->assertTrue(true === $options['secure']);
        $this->assertTrue(false !== strpos($options['base_uri'], 'https://'));

        $client = new Client(
            [
                'api_token' => new ApiToken('test'),
                'secure' => true,
                'event_dispatcher' => ['adapter' => new EventDispatcher()]
            ]
        );
        $options = $client->getOptions();
        $this->assertTrue(true === $options['secure']);
        $this->assertTrue(false !== strpos($options['base_uri'], 'https://'));

        $client = new Client(
            [
                'api_token' => new ApiToken('test'),
                'secure' => false,
                'event_dispatcher' => ['adapter' => new EventDispatcher()]
            ]
        );
        $options = $client->getOptions();
        $this->assertTrue(false === $options['secure']);
        $this->assertTrue(false !== strpos($options['base_uri'], 'http://'));
    }

    public function testShouldSwitchHttpScheme()
    {
        $client = new Client(
            [
                'api_token' => new ApiToken(self::API_TOKEN),
                'event_dispatcher' => ['adapter' => new EventDispatcher()]
            ]
        );

        $options = $client->getOptions();

        $this->assertEquals('https://api.themoviedb.org/3', $options['base_uri']);

        $options['secure'] = false;
        $client = new Client($options);

        $options = $client->getOptions();

        $this->assertEquals('http://api.themoviedb.org/3', $options['base_uri']);
    }

    /**
     * @test
     */
    public function shouldBeAbleGetOption()
    {
        $token = $this->client->getOption('api_token');
        $invalidOption = $this->client->getOption('invalid_key');

        $this->assertEquals(self::API_TOKEN, $token);
        $this->assertEquals(null, $invalidOption);
    }
}
