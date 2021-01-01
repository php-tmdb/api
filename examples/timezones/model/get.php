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
use Tmdb\Repository\TimezoneRepository;

require_once '../../../vendor/autoload.php';
require_once '../../apikey.php';

/** @var Tmdb\Client $client **/
$client = require_once('../../setup-client.php');
$client = new Client(
    $token,
    [
                               'event_dispatcher' => [
                                   'adapter' => new Symfony\Component\EventDispatcher\EventDispatcher()
                               ]
                           ]
);

$repository = new TimezoneRepository($client);
$timezones = $repository->getTimezones();

var_dump($timezones->getCountry('NL')->supports('Europe/Amsterdam'));

var_dump($timezones);
