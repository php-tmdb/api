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
namespace Tmdb\Factory;

use Tmdb\Factory\Common\GenericCollectionFactory;
use Tmdb\Factory\People\CastFactory;
use Tmdb\Factory\People\CrewFactory;

use Tmdb\Model\Common\Collection;

use Tmdb\Model\Common\Translation;
use Tmdb\Model\Tv\ExternalIds;
use Tmdb\Model\Tv;

class TvFactory extends AbstractFactory {
    /**
     * {@inheritdoc}
     */
    public static function create(array $data = array())
    {
        if (!$data) {
            return null;
        }

        $tvShow = new Tv();

        if (array_key_exists('credits', $data)) {
            if (array_key_exists('cast', $data['credits'])) {
                $tvShow->getCredits()->setCast(CastFactory::createCollection($data['credits']['cast'], new Tv\Person\CastMember()));
            }

            if (array_key_exists('crew', $data['credits'])) {
                $tvShow->getCredits()->setCrew(CrewFactory::createCollection($data['credits']['crew'], new Tv\Person\CrewMember()));
            }
        }

        /** External ids */
        if (array_key_exists('external_ids', $data)) {
            $tvShow->setExternalIds(
                parent::hydrate(new ExternalIds(), $data['external_ids'])
            );
        }

        /** Genres */
        if (array_key_exists('genres', $data)) {
            $tvShow->setGenres(GenreFactory::createCollection($data['genres']));
        }

        /** Images */
        if (array_key_exists('images', $data)) {
            $tvShow->setImages(ImageFactory::createCollectionFromTv($data['images']));
        }

        /** Translations */
        if (array_key_exists('translations', $data)) {
            $tvShow->setTranslations(GenericCollectionFactory::createCollection($data['translations']['translations'], new Translation()));
        }

        /** Seasons */
        if (array_key_exists('seasons', $data)) {
            $tvShow->setSeasons(TvSeasonFactory::createCollection($data['seasons']));
        }

        /** Networks */
        if (array_key_exists('networks', $data)) {
            $tvShow->setNetworks(GenericCollectionFactory::createCollection($data['networks'], new Tv\Network()));
        }

        return parent::hydrate($tvShow, $data);
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollection(array $data = array())
    {
        $collection = new Collection();

        foreach($data as $item) {
            $collection->add(null, self::create($item));
        }

        return $collection;
    }
}
