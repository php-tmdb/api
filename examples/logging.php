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
use Tmdb\Repository\MovieRepository;

require_once '../vendor/autoload.php';
require_once 'apikey.php';

/** @var Tmdb\Client $client **/
$client = require_once('setup-client.php');
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
$client = new Client(
    $token,
    [
    'log' => [
        'enabled' => true,
        'handler' => new ChromePHPHandler() // chrome php extension
    //        'handler' => new \Monolog\Handler\FirePHPHandler() // firefox php extension
    ]
    ]
);

$repository = new MovieRepository($client);
$movie = $repository->load(19995);
