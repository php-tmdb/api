<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Factory;

use Tmdb\Exception\RuntimeException;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Image;

/**
 * Class ImageFactory.
 *
 * @extends AbstractFactory<Image>
 */
class ImageFactory extends AbstractFactory
{
    /**
     * Create an image instance based on the path and type, e.g.
     *
     * '/xkQ5yWnMjpC2bGmu7GsD66AAoKO.jpg', 'backdrop_path'
     *
     * @param string $key
     *
     * @return ($key is ('poster'|'posters'|'poster_path') ? Image\PosterImage
     *          : $key is ('backdrop'|'backdrops'|'backdrop_path') ? Image\BackdropImage
     *          : $key is ('profile'|'profiles'|'profile_path') ? Image\ProfileImage
     *          : $key is ('logo'|'logos'|'logo_path') ? Image\LogoImage
     *          : $key is ('still'|'stills'|'still_path') ? Image\StillImage
     *          : Image)
     */
    public function createFromPath($path, $key)
    {
        return $this->hydrate(
            self::resolveImageType($key),
            ['file_path' => $path],
        );
    }

    /**
     * Helper function to obtain a new object for an image type.
     *
     * @param string|null $key
     *
     * @return ($key is ('poster'|'posters'|'poster_path') ? Image\PosterImage
     *          : $key is ('backdrop'|'backdrops'|'backdrop_path') ? Image\BackdropImage
     *          : $key is ('profile'|'profiles'|'profile_path') ? Image\ProfileImage
     *          : $key is ('logo'|'logos'|'logo_path') ? Image\LogoImage
     *          : $key is ('still'|'stills'|'still_path') ? Image\StillImage
     *          : Image)
     */
    public function resolveImageType($key = null)
    {
        return match ($key) {
            'poster', 'posters', 'poster_path' => new Image\PosterImage(),
            'backdrop', 'backdrops', 'backdrop_path' => new Image\BackdropImage(),
            'profile', 'profiles', 'profile_path' => new Image\ProfileImage(),
            'logo', 'logos', 'logo_path' => new Image\LogoImage(),
            'still', 'stills', 'still_path' => new Image\StillImage(),
            default => new Image(),
        };
    }

    /**
     * Create an Media/Image type which is used in calls like person/tagged_images, which contains an getMedia()
     * reference either referring to movies / tv shows etc.
     *
     * @throws \RuntimeException
     */
    public function createMediaImage(array $data = []): Image
    {
        $type = $this->resolveImageType($data['image_type'] ?? null);
        $image = $this->hydrate($type, $data);

        if (\array_key_exists('media', $data) && \array_key_exists('media_type', $data)) {
            $factory = match ($data['media_type']) {
                'movie' => new MovieFactory($this->getHttpClient()),
                'tv' => new TvFactory($this->getHttpClient()),
                'season' => new TvSeasonFactory($this->getHttpClient()),
                'episode' => new TvEpisodeFactory($this->getHttpClient()),
                'person' => new PeopleFactory($this->getHttpClient()),
                default => throw new RuntimeException(\sprintf('Unrecognized media_type "%s" for method "%s::%s".', $data['media_type'], self::class, __METHOD__)),
            };
            $media = $factory->create($data['media']);
            $image->setMedia($media);
        }

        return $image;
    }

    /**
     * Create generic collection.
     */
    #[\Override]
    public function createCollection(array $data = []): Images
    {
        $collection = new Images();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    /**
     * Convert an array to an hydrated object.
     *
     * @param string|null $key
     */
    #[\Override]
    public function create(array $data = [], $key = null): Image
    {
        $type = self::resolveImageType($key);

        return $this->hydrate($type, $data);
    }

    /**
     * Create full movie collection.
     *
     * @return Images
     */
    public function createCollectionFromMovie(array $data = [])
    {
        return $this->createImageCollection($data);
    }

    /**
     * Create full collection.
     */
    public function createImageCollection(array $data = []): \Tmdb\Model\Collection\Images
    {
        $collection = new Images();

        foreach ($data as $format => $formatCollection) {
            if (!\is_array($formatCollection)) {
                continue;
            }

            foreach ($formatCollection as $item) {
                if (\array_key_exists($format, Image::$formats)) {
                    $item = $this->create($item, $format);

                    $collection->addImage($item);
                }
            }
        }

        return $collection;
    }

    /**
     * Create full tv show collection.
     *
     * @return Images
     */
    public function createCollectionFromTv(array $data = [])
    {
        return $this->createImageCollection($data);
    }

    /**
     * Create full tv season collection.
     *
     * @return Images
     */
    public function createCollectionFromTvSeason(array $data = [])
    {
        return $this->createImageCollection($data);
    }

    /**
     * Create full tv episode collection.
     *
     * @return Images
     */
    public function createCollectionFromTvEpisode(array $data = [])
    {
        return $this->createImageCollection($data);
    }

    /**
     * Create full people collection.
     *
     * @return Images
     */
    public function createCollectionFromPeople(array $data = [])
    {
        return $this->createImageCollection($data);
    }
}
