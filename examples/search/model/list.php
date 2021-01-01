<?php

// @todo 4.0 API seems to throw an error?

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

use Tmdb\Model\Search\SearchQuery\ListSearchQuery;
use Tmdb\Repository\SearchRepository;

require_once '../../../vendor/autoload.php';
require_once '../../apikey.php';

/** @var Tmdb\Client $client **/
$client = require_once('../../setup-client.php');
$query = new ListSearchQuery();
$query->page(1);

$repository = new SearchRepository($client);

$find = $repository->searchList('award', $query);

var_dump($find);
