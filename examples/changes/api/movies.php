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

require_once '../../../vendor/autoload.php';
require_once '../../../apikey.php';

/** @var Tmdb\Client $client **/
$client = require_once('../../../setup-client.php');
$movieChanges = $client->getChangesApi()->getMovieChanges(
    [
        'page' => 1,
        'start_date' => '2014-01-01',
        'end_date' => '2014-01-02'
    ]
);

var_dump($movieChanges);
