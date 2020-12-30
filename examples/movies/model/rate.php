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

use Monolog\Handler\ChromePHPHandler;
use Tmdb\Client;
use Tmdb\GuestSessionToken;
use Tmdb\Repository\MovieRepository;

require_once '../../../vendor/autoload.php';
require_once '../../../apikey.php';

$client = require_once('../../../setup-client.php');
$client = new Client(
    $token,
    [
                               'session_token' => new GuestSessionToken(TMDB_GUEST_SESSION_TOKEN),
                               'log' => ['enabled' => true, 'handler' => new ChromePHPHandler()]
                           ]
);

/**
 * $sessionToken      = new \Tmdb\SessionToken(TMDB_SESSION_TOKEN);
 * $client->setSessionToken($sessionToken);
 */

$guestSessionToken = new GuestSessionToken(TMDB_GUEST_SESSION_TOKEN);
$client->setSessionToken($guestSessionToken);

$repository = new MovieRepository($client);
$rate = $repository->rate(49047, 6.5);

var_dump($rate);
