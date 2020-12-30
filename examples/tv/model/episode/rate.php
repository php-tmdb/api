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

use Tmdb\Repository\TvEpisodeRepository;
use Tmdb\SessionToken;

ini_set('display_errors', 'on');
require_once '../../../../vendor/autoload.php';
require_once '../../../../apikey.php';

$client = require_once('../../../../setup-client.php');
$sessionToken = new SessionToken(TMDB_SESSION_TOKEN);
$client->setSessionToken($sessionToken);

$repository = new TvEpisodeRepository($client);
$rate = $repository->rate(1396, 1, 1, 9.5);

var_dump($rate);
