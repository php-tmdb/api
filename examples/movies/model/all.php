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
header('Content-Type: text/html; charset=utf-8');

require_once '../../../vendor/autoload.php';
require_once '../../../apikey.php';

$token  = new \Tmdb\ApiToken(TMDB_API_KEY);
$client = new \Tmdb\Client($token);

$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
$config = $configRepository->load();

$imageHelper = new \Tmdb\Helper\ImageHelper($config);
$repository  = new \Tmdb\Repository\MovieRepository($client);

/**
 * @var \Tmdb\Model\Movie $movie
 */
$movie = $repository->load(87421);
var_dump($movie);exit;
echo $movie->getTitle() . "<br/>";

echo "Alternative Titles<br/>";

foreach ($movie->getAlternativeTitles()->filterCountry('US') as $title) {
    printf(" - %s [%s]<br/>", $title->getTitle(), $title->getIso31661());
}

echo "Cast<br/>";

foreach ($movie->getCredits()->getCast() as $person) {
    echo $imageHelper->getHtml($person->getProfileImage(), 'w45');
    printf(" - %s as %s<br/>", $person->getName(), $person->getCharacter());
}

echo "Crew<br/>";

foreach ($movie->getCredits()->getCrew() as $person) {
    echo $imageHelper->getHtml($person->getProfileImage(), 'w45');
    printf(" - %s as %s<br/>", $person->getName(), $person->getJob());
}

echo "Images<br/>";

// All collection classes support filtering by closure functions, provided by the generic collection implementation.
foreach($movie->getImages()->filter(
        function ($key, $value) {
            if ($value->getIso6391() == 'en' && $value instanceof \Tmdb\Model\Image\PosterImage) { return true; }
        }
    ) as $image) {
    echo $imageHelper->getHtml($image, 'w154', 150);

    printf(" - %s<br/>", $imageHelper->getUrl($image));
}

// There are however some sensible default filters available for most collections
$backdrop = $movie
    ->getImages()
    ->filterBackdrops()
    ->filterBestVotedImage()
;

echo $imageHelper->getHtml($backdrop, 'original', '1024');

echo "Genres<br/>";

foreach ($movie->getGenres() as $genre) {
    printf(" - %s<br/>", $genre->getName());
}

echo "Keywords<br/>";

foreach ($movie->getKeywords() as $keyword) {
    printf(" - %s [%s]<br/>", $keyword->getName(), $keyword->getId());
}

echo "Releases<br/>";

foreach ($movie->getReleases()->filterCountry('US') as $release) {
    printf(" - %s on %s<br/>", $release->getIso31661(), $release->getReleaseDate()->format('d-m-Y'));
}

echo "Translations<br/>";

foreach ($movie->getTranslations()->filterLanguage('en') as $translation) {
    printf(" - %s<br/>", $translation->getName());
}

echo "Trailers<br/>";

foreach ($movie->getTrailers() as $trailer) {
    printf(" - %s<br/>", $trailer->getUrl());
}

$popular = $repository->getPopular();

echo "Popular titles<br/>";

foreach ($popular as $p) {
    printf(" - %s<br/>", $p->getTitle());
}

$topRated = $repository->getTopRated(['page' => 3]);

echo "Top rated<br/>";

foreach ($topRated as $t) {
    printf(" - %s<br/>", $t->getTitle());
}
