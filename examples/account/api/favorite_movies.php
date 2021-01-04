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

use Tmdb\Client;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Session\SessionToken;

require_once '../../../vendor/autoload.php';
require_once '../../apikey.php';

/** @var Client $client * */
$client = require_once('../../setup-client.php');
$token = new ApiToken(TMDB_API_KEY);
$client->getEventDispatcher()->addListener(
    BeforeRequestEvent::class,
    new Tmdb\Event\Listener\Request\SessionTokenRequestListener(
        new SessionToken(TMDB_SESSION_TOKEN)
    )
);

$favorite_movies = $client->getAccountApi()->getFavoriteMovies(TMDB_ACCOUNT_ID);

var_dump($favorite_movies);
