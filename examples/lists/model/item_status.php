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

use Tmdb\Repository\ListRepository;

require_once '../../../vendor/autoload.php';
require_once '../../apikey.php';

/** @var Tmdb\Client $client **/
$client = require_once('../../setup-client.php');
$client->getEventDispatcher()->addListener(
    \Tmdb\Event\BeforeRequestEvent::class,
    new Tmdb\Event\Listener\Request\SessionTokenRequestListener(
        new \Tmdb\Token\Session\SessionToken(TMDB_SESSION_TOKEN)
    )
);

$repository = new ListRepository($client);
$list = $repository->getItemStatus('509ec17b19c2950a0600050d', 150);

var_dump($list);
