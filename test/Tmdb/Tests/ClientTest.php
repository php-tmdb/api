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
    const API_TOKEN     = 'abcdef';
    const SESSION_TOKEN = '80b2bf99520cd795ff54e31af97917bc9e3a7c8c';

    /**
     * @var Client
     */
    private $client = null;

    public function setUp()
    {
        $token        = new ApiToken(self::API_TOKEN);
        $sessionToken = new SessionToken(self::SESSION_TOKEN);

        $client = new Client($token, ['session_token' => $sessionToken]);

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
                'getAccountApi'        => 'Tmdb\Api\Account',
                'getAuthenticationApi' => 'Tmdb\Api\Authentication',
                'getCertificationsApi' => 'Tmdb\Api\Certifications',
                'getChangesApi'        => 'Tmdb\Api\Changes',
                'getCollectionsApi'    => 'Tmdb\Api\Collections',
                'getCompaniesApi'      => 'Tmdb\Api\Companies',
                'getConfigurationApi'  => 'Tmdb\Api\Configuration',
                'getCreditsApi'        => 'Tmdb\Api\Credits',
                'getDiscoverApi'       => 'Tmdb\Api\Discover',
                'getFindApi'           => 'Tmdb\Api\Find',
                'getGenresApi'         => 'Tmdb\Api\Genres',
                'getGuestSessionApi'   => 'Tmdb\Api\GuestSession',
                'getJobsApi'           => 'Tmdb\Api\Jobs',
                'getKeywordsApi'       => 'Tmdb\Api\Keywords',
                'getListsApi'          => 'Tmdb\Api\Lists',
                'getMoviesApi'         => 'Tmdb\Api\Movies',
                'getNetworksApi'       => 'Tmdb\Api\Networks',
                'getPeopleApi'         => 'Tmdb\Api\People',
                'getReviewsApi'        => 'Tmdb\Api\Reviews',
                'getSearchApi'         => 'Tmdb\Api\Search',
                'getTimezonesApi'      => 'Tmdb\Api\Timezones',
                'getTvApi'             => 'Tmdb\Api\Tv',
                'getTvSeasonApi'       => 'Tmdb\Api\TvSeason',
                'getTvEpisodeApi'      => 'Tmdb\Api\TvEpisode',
            ]
        );
    }

    public function testShouldSwitchHttpScheme()
    {
        $token  = new ApiToken(self::API_TOKEN);
        $client = new Client($token);

        $options = $client->getOptions();

        $this->assertEquals('https://api.themoviedb.org/3/', $options['base_url']);

        $options['secure'] = false;
        $client->setOptions($options);

        $options = $client->getOptions();

        $this->assertEquals('http://api.themoviedb.org/3/', $options['base_url']);
    }

    /**
     * @test
     */
    public function shouldAddCachePluginWhenEnabled()
    {
        $token  = new ApiToken(self::API_TOKEN);
        $client = new Client($token);

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
        $client = new Client($token, ['log' => ['enabled' => true]]);

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
     * @todo
     */
    public function shouldBeAbleSetCache()
    {
        $path = '/tmp/php-tmdb-api';

        $this->client->setCaching(true, $path);

        $this->assertEquals(true, $this->client->getCacheEnabled());
        $this->assertEquals($path, $this->client->getCachePath());
    }

    /**
     * @todo
     */
    public function shouldBeAbleSetLogging()
    {
        $path = '/tmp/php-tmdb-api.log';

        $this->client->setLogging(true, $path);

        $this->assertEquals(true, $this->client->getLogEnabled());
        $this->assertEquals($path, $this->client->getLogPath());
    }
}
