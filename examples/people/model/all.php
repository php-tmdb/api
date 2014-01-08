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
require_once('../../../vendor/autoload.php');
require_once('../../../apikey.php');

$token  = new \Tmdb\ApiToken(TMDB_API_KEY);
$client = new \Tmdb\Client($token);

// This is optional, but if you want lots of data this is the way.
$append = new \Tmdb\Model\Person\QueryParameter\AppendToResponse(array(
    \Tmdb\Model\Person\QueryParameter\AppendToResponse::IMAGES,
    \Tmdb\Model\Person\QueryParameter\AppendToResponse::CHANGES,
    \Tmdb\Model\Person\QueryParameter\AppendToResponse::COMBINED_CREDITS,
    \Tmdb\Model\Person\QueryParameter\AppendToResponse::LATEST,
    \Tmdb\Model\Person\QueryParameter\AppendToResponse::MOVIE_CREDITS,
    \Tmdb\Model\Person\QueryParameter\AppendToResponse::TV_CREDITS,
    \Tmdb\Model\Person\QueryParameter\AppendToResponse::POPULAR
));

$repository = new \Tmdb\Repository\PersonRepository($client);
$person      = $repository->load(33, array($append));

var_dump($person);