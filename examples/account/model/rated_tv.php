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
use Tmdb\Repository\AccountRepository;
use Tmdb\SessionToken;

require_once '../../../vendor/autoload.php';
require_once '../../../apikey.php';

$client = require_once('../../../setup-client.php');
$client = new Client($token, ['session_token' => new SessionToken(TMDB_SESSION_TOKEN)]);

/**
 * @var AccountRepository $accountRepository
 */
$accountRepository = new AccountRepository($client);
$lists = $accountRepository->getRatedTvShows(TMDB_ACCOUNT_ID);

var_dump($lists);
