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

use Tmdb\Repository\FindRepository;

require_once '../../../vendor/autoload.php';
require_once '../../apikey.php';

/** @var Tmdb\Client $client **/
$client = require_once('../../setup-client.php');
$repository = new FindRepository($client);
$find = $repository->findBy('tt0120737', ['external_source' => 'imdb_id']);

var_dump($find);
