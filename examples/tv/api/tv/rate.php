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

use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Token\Session\SessionToken;

ini_set('display_errors', 'On');
require_once '../../../../vendor/autoload.php';
require_once '../../../apikey.php';

/** @var Tmdb\Client $client * */
$client = require_once('../../../setup-client.php');
$client->getEventDispatcher()->addListener(
    BeforeRequestEvent::class,
    new Tmdb\Event\Listener\Request\SessionTokenRequestListener(
        new SessionToken(TMDB_SESSION_TOKEN)
    )
);

$result = $client->getTvApi()->rateTvShow(1396, 9.5);

var_dump($result);
