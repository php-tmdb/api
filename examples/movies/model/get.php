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

    $movie = \Tmdb\Model\Movie::load($client, 87421, array(
        'append_to_response' => 'casts,images'
    ));

    echo $movie->getTitle() . "\n";

    echo "Cast\n";

    foreach($movie->getCast() as $person) {
        printf(" - %s as %s\n", $person->getName(), $person->getCharacter());
    }

    foreach($movie->getCrew() as $person) {
        printf(" - %s as %s\n", $person->getName(), $person->getJob());
    }

    echo "Images\n";

    foreach($movie->getImages() as $image) {
        printf(" - %s\n", $image->getFilePath());
    }

    echo "Genres\n";

    foreach($movie->getGenres() as $genre) {
        printf(" - %s\n", $genre->getName());
    }