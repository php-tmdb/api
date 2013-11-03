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

$append = new \Tmdb\Model\Movie\QueryParameter\AppendToResponse(array(
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::ALTERNATIVE_TITLES,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::CHANGES,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::CREDITS,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::IMAGES,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::KEYWORDS,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::LISTS,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::RELEASES,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::REVIEWS,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::SIMILAR_MOVIES,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::TRAILERS,
    \Tmdb\Model\Movie\QueryParameter\AppendToResponse::TRANSLATIONS,
));

$movie = \Tmdb\Model\Movie::load($client, 87421, array($append, $language));


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