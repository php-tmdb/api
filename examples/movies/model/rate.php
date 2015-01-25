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
require_once '../../../vendor/autoload.php';
require_once '../../../apikey.php';

$token  = new \Tmdb\ApiToken(TMDB_API_KEY);
$client = new \Tmdb\Client($token, ['session_token' => new \Tmdb\GuestSessionToken(TMDB_GUEST_SESSION_TOKEN), 'log' => ['enabled' => true, 'handler' => new \Monolog\Handler\ChromePHPHandler()]]);

/**
$sessionToken      = new \Tmdb\SessionToken(TMDB_SESSION_TOKEN);
$client->setSessionToken($sessionToken);
*/

$guestSessionToken = new \Tmdb\GuestSessionToken(TMDB_GUEST_SESSION_TOKEN);
$client->setSessionToken($guestSessionToken);

$repository = new \Tmdb\Repository\MovieRepository($client);
$rate = $repository->rate(49047, 6.5);

var_dump($rate);
