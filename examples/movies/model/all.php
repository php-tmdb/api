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

$repository = new \Tmdb\Repository\MovieRepository($client);
$movie      = $repository->load(87421, array($append));

echo $movie->getTitle() . "\n";

echo "Alternative Titles\n";

foreach($movie->getAlternativeTitles() as $title) {
    printf(" - %s [%s]\n", $title->getTitle(), $title->getIso31661());
}

echo "Cast\n";

foreach($movie->getCredits()->getCast() as $person) {
    printf(" - %s as %s\n", $person->getName(), $person->getCharacter());
}

echo "Crew\n";

foreach($movie->getCredits()->getCrew() as $person) {
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

echo "Keywords\n";

foreach($movie->getKeywords() as $keyword) {
    printf(" - %s [%s]\n", $keyword->getName(), $keyword->getId());
}

echo "Releases\n";

foreach($movie->getReleases() as $release) {
    printf(" - %s on %s\n", $release->getIso31661(), $release->getReleaseDate()->format('d-m-Y'));
}

echo "Translations\n";

foreach($movie->getTranslations() as $translation) {
    printf(" - %s\n", $translation->getName());
}

echo "Trailers\n";

foreach($movie->getTrailers() as $trailer) {
    printf(" - %s\n", $trailer->getUrl());
}