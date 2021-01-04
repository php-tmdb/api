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

use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Token\Session\GuestSessionToken;

require_once '../../../vendor/autoload.php';
require_once '../../apikey.php';

/** @var Tmdb\Client $client * */
$client = require_once('../../setup-client-guest-session.php');

$rated_movies = $client->getGuestSessionApi()->getRatedMovies();

var_dump($rated_movies);
