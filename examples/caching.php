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
use Tmdb\Repository\MovieRepository;

require_once '../vendor/autoload.php';
require_once 'apikey.php';

/** @var Client $client **/
$client = require_once('setup-client-cache-psr6.php');

$repository = new MovieRepository($client);
$movie = $repository->load(19995);

var_dump($movie);
exit;
