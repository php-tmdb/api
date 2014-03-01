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

$sessionToken = new \Tmdb\SessionToken(TMDB_SESSION_TOKEN);
$client->setSessionToken($sessionToken);

$repository = new \Tmdb\Repository\ListRepository($client);
$list       = $repository->getItemStatus('509ec17b19c2950a0600050d', 150);

var_dump($list);
