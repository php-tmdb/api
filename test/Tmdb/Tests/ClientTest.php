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

class ClientTest extends \Tmdb\Tests\TestCase
{
    const API_TOKEN = 'abcdef';
    const SESSION_TOKEN = '80b2bf99520cd795ff54e31af97917bc9e3a7c8c';

    /**
     * @var Tmdb\Client
     */
    private $client = null;

    public function setUp()
    {
        $token        = new \Tmdb\ApiToken(self::API_TOKEN);
        $sessionToken = new \Tmdb\SessionToken(self::SESSION_TOKEN);

        $client = new \Tmdb\Client($token);
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
            array(
                'getAuthenticationApi' => 'Tmdb\Api\Authentication',
                'getAccountApi'        => 'Tmdb\Api\Account',
                'getCollectionsApi'    => 'Tmdb\Api\Collections',
                'getMoviesApi'         => 'Tmdb\Api\Movies',
                'getTvApi'             => 'Tmdb\Api\Tv',
                'getTvSeasonApi'       => 'Tmdb\Api\TvSeason',
                'getTvEpisodeApi'      => 'Tmdb\Api\TvEpisode',
                'getPeopleApi'         => 'Tmdb\Api\People',
                'getListsApi'          => 'Tmdb\Api\Lists',
                'getCompaniesApi'      => 'Tmdb\Api\Companies',
                'getGenresApi'         => 'Tmdb\Api\Genres',
                'getKeywordsApi'       => 'Tmdb\Api\Keywords',
                'getDiscoverApi'       => 'Tmdb\Api\Discover',
                'getSearchApi'         => 'Tmdb\Api\Search',
                'getReviewsApi'        => 'Tmdb\Api\Reviews',
                'getChangesApi'        => 'Tmdb\Api\Changes',
                'getJobsApi'           => 'Tmdb\Api\Jobs',
            )
        );
    }

    /**
     * @test
     */
    public function shouldAddCachePluginWhenEnabled()
    {
        $token  = new \Tmdb\ApiToken(self::API_TOKEN);
        $client = new \Tmdb\Client($token);
        $client->setCaching(true, '/tmp/php-tmdb-api');

        $listeners = $client->getHttpClient()
            ->getClient()
            ->getEventDispatcher()
            ->getListeners();

        $this->assertEquals(true, $this->isListenerRegistered(
            $listeners,
            'Guzzle\Plugin\Cache\CachePlugin'
        ));
    }

    /**
     * @test
     */
    public function shouldAddLoggingPluginWhenEnabled()
    {
        $token  = new \Tmdb\ApiToken(self::API_TOKEN);
        $client = new \Tmdb\Client($token);
        $client->setLogging(true, '/tmp/php-tmdb-api.log');

        $listeners = $client->getHttpClient()
            ->getClient()
            ->getEventDispatcher()
            ->getListeners();

        $this->assertEquals(true, $this->isListenerRegistered(
            $listeners,
            'Guzzle\Plugin\Log\LogPlugin'
        ));
    }

    /**
     * Find an plugin in an listeners array
     *
     * @param $listeners
     * @param $class
     * @return bool
     */
    private function isListenerRegistered($listeners, $class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        if (is_array($listeners)) {
            foreach ($listeners as $subject) {
                if (is_object($subject) && get_class($subject) === $class) {
                    return true;
                }

                if (is_array($subject)) {
                    return $this->isListenerRegistered($subject, $class);
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
