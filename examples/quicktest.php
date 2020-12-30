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

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

require_once '../vendor/autoload.php';
require_once '../apikey.php';

$token  = new \Tmdb\Token\Api\ApiToken(TMDB_API_KEY);

// A simple change the path of the log
/*
$client = new \Tmdb\Client($token, [
    'log' => [
        'enabled' => true,
        'path'    => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'application-api.log'
    ]
]);
*/

// If you'd like to know what's going on during development, something like this could prove handy.

$ed = new Symfony\Component\EventDispatcher\EventDispatcher();
$client = new \Tmdb\Client($token, [
    'event_dispatcher' => [
        'adapter' => $ed
    ],
    'log' => [
        'enabled' => false,
//        'handler' => new \Monolog\Handler\ChromePHPHandler() // chrome php extension
//        'handler' => new \Monolog\Handler\FirePHPHandler() // firefox php extension
    ]
]);


$requestListener = new \Tmdb\Event\Listener\RequestListener($client->getHttpClient(), $ed);
$apiTokenListener = new \Tmdb\Event\Listener\Request\ApiTokenRequestListener($client->getToken());
$adultFilterListener = new \Tmdb\Event\Listener\Request\AdultFilterRequestListener(true);
$languageFilterListener = new \Tmdb\Event\Listener\Request\LanguageFilterRequestListener('nl');
$acceptJsonListener = new \Tmdb\Event\Listener\Request\AcceptJsonRequestListener();
$jsonContentTypeListener = new \Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener();
$psr16CacheListener = new \Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener();

$ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $apiTokenListener);
$ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $acceptJsonListener);
$ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $jsonContentTypeListener);
$ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $adultFilterListener);
$ed->addListener(\Tmdb\Event\BeforeRequestEvent::class, $languageFilterListener);
$ed->addListener(\Tmdb\Event\RequestEvent::class, $requestListener);
//$ed->addListener(\Tmdb\Event\ResponseEvent::class, [$requestListener, '__invoke']);

$repository = new \Tmdb\Repository\MovieRepository($client);
$movie      = $repository->load(19995);

var_dump($movie);
