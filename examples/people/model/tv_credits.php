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

$token  = new \Tmdb\Token\Api\ApiToken(TMDB_API_KEY);
$client = new \Tmdb\Client($token);

$repository = new \Tmdb\Repository\PeopleRepository($client);
$person      = $repository->getTvCredits(33);

var_dump($person);
