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
require_once '../vendor/autoload.php';
require_once '../apikey.php';

$token  = new \Tmdb\ApiToken(TMDB_API_KEY);

// Caching is enabled by default, and makes use of your sys_get_temp_dir()
// If you'd like to disable it or change the path:

//$client = new \Tmdb\Client($token, null, true, [
//    'cache' => ['enabled' => false]
//]);

$client = new \Tmdb\Client($token, [
    'cache' => [
        'enabled' => true,
        'handler' => new Doctrine\Common\Cache\FilesystemCache(sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'my-cache-path')
    ]
]);

$repository = new \Tmdb\Repository\MovieRepository($client);
$movie      = $repository->load(19995);

var_dump($movie);
