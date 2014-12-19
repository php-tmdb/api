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

use Tmdb\ApiToken;
use Tmdb\Client;
use Tmdb\SessionToken;

class ClientTest extends \Tmdb\Tests\TestCase
{
    const API_TOKEN = 'abcdef';
    const SESSION_TOKEN = '80b2bf99520cd795ff54e31af97917bc9e3a7c8c';

    /**
     * @var Client
     */
    private $client = null;

    public function setUp()
    {
        $token        = new ApiToken(self::API_TOKEN);
        $sessionToken = new SessionToken(self::SESSION_TOKEN);

        $client = new Client($token);
        $client->setSessionToken($sessionToken);

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
    public function shouldContainSessionToken()
    {
        $this->assertInstanceOf('Tmdb\SessionToken', $this->client->getSessionToken());
        $this->assertEquals(self::SESSION_TOKEN, $this->client->getSessionToken()->getToken());
    }

    /**
     * @test
     */
    public function assertInstances()
    {
        $this->assertInstancesOf(
            $this->client,
            [
                'getAuthenticationApi' => 'Tmdb\Api\Authentication',
                'getAccountApi'        => 'Tmdb\Api\Account',
                'getCollectionsApi'    => 'Tmdb\Api\Collections',
                'getMoviesApi'         => 'Tmdb\Api\Movies',
                'getTvApi'             => 'Tmdb\Api\Tv',
                'getTvSeasonApi'       => 'Tmdb\Api\TvSeason',
                'getTvEpisodeApi'      => 'Tmdb\Api\TvEpisode',
                'getPeopleApi'         => 'Tmdb\Api\People',
                'getGuestSessionApi'   => 'Tmdb\Api\GuestSession',
                'getListsApi'          => 'Tmdb\Api\Lists',
                'getCompaniesApi'      => 'Tmdb\Api\Companies',
                'getGenresApi'         => 'Tmdb\Api\Genres',
                'getKeywordsApi'       => 'Tmdb\Api\Keywords',
                'getDiscoverApi'       => 'Tmdb\Api\Discover',
                'getSearchApi'         => 'Tmdb\Api\Search',
                'getReviewsApi'        => 'Tmdb\Api\Reviews',
                'getChangesApi'        => 'Tmdb\Api\Changes',
                'getJobsApi'           => 'Tmdb\Api\Jobs',
                'getTimezonesApi'      => 'Tmdb\Api\Timezones',
            ]
        );
    }

    /**
     * @test
     */
    public function shouldAddCachePluginWhenEnabled()
    {
        $token  = new ApiToken(self::API_TOKEN);
        $client = new Client($token);
        $client->setCaching(true, '/tmp/php-tmdb-api');

        $listeners = $client->getHttpClient()->getAdapter()->getClient()
            ->getEmitter()
            ->listeners();

        $this->assertEquals(true, $this->isListenerRegistered(
            $listeners,
            'GuzzleHttp\Subscriber\Cache\CacheSubscriber'
        ));
    }

    /**
     * @test
     */
    public function shouldAddLoggingPluginWhenEnabled()
    {
        $token  = new ApiToken(self::API_TOKEN);
        $client = new Client($token);
        $client->setLogging(true, '/tmp/php-tmdb-api.log');

        $listeners = $client->getHttpClient()->getAdapter()->getClient()
            ->getEmitter()
            ->listeners();

        $this->assertEquals(true, $this->isListenerRegistered(
            $listeners,
            'GuzzleHttp\Subscriber\Log\LogSubscriber'
        ));
    }

    /**
     * Find an plugin in an listeners array
     *
     * @param $listeners
     * @param $class
     * @return bool
     */
    private function isListenerRegistered($events, $class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        if (is_array($events)) {
            foreach ($events as $listeners) {
                foreach ($listeners as $subject) {
                    $subject = array_shift($subject);

                    if (is_object($subject) && get_class($subject) === $class) {
                        return true;
                    }

                    if (is_array($subject)) {
                        return $this->isListenerRegistered($subject, $class);
                    }
                }
            }
        }

        return false;
    }

    /**
     * @test
     */
    public function shouldBeAbleSetCache()
    {
        $path = '/tmp/php-tmdb-api';

        $this->client->setCaching(true, $path);

        $this->assertEquals(true, $this->client->getCacheEnabled());
        $this->assertEquals($path, $this->client->getCachePath());
    }

    /**
     * @test
     */
    public function shouldBeAbleSetLogging()
    {
        $path = '/tmp/php-tmdb-api.log';

        $this->client->setLogging(true, $path);

        $this->assertEquals(true, $this->client->getLogEnabled());
        $this->assertEquals($path, $this->client->getLogPath());
    }
}
