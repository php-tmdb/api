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

$query = new \Tmdb\Model\Query\ChangesQuery();

$from = new \DateTime('01-01-2014');
$to   = new \DateTime('02-01-2014');

$query
    ->page(1)
    ->from($from)
    ->to($to)
;

$repository = new \Tmdb\Repository\ChangesRepository($client);
$response = $repository->getMovieChanges($query);

var_dump($response);
