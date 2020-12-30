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
use Tmdb\SessionToken;
use Tmdb\Token\Api\ApiToken;

require_once '../../../vendor/autoload.php';
require_once '../../../apikey.php';

/** @var Tmdb\Client $client **/
$client = require_once('../../../setup-client.php');
$token = new ApiToken(TMDB_API_KEY);
$client = new Client($token, ['session_token' => new SessionToken(TMDB_SESSION_TOKEN)]);

$account = $client->getAccountApi()->getAccount();

var_dump($account);
