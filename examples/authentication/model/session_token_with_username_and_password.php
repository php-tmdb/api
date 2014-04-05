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
$client = new \Tmdb\Client($token);

$client->setLogging(true, '/www/dev/php-tmdb-api/tmdb.log');

$requestToken = new \Tmdb\RequestToken(TMDB_REQUEST_TOKEN);

$authenticationRepository = new \Tmdb\Repository\AuthenticationRepository($client);

$sessionToken = $authenticationRepository->getSessionTokenWithLogin(
    $requestToken,
    TMDB_USERNAME,
    TMDB_PASSWORD
);

var_dump($sessionToken);
