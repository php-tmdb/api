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

use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Collection;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Translation;

/**
 * Class CollectionFactory.
 */
class CollectionFactory extends AbstractFactory
{
    /**
     * @var ImageFactory|mixed
     */
    private $imageFactory;

    /**
     * @var MovieFactory|mixed
     */
    private $movieFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->movieFactory = new MovieFactory($httpClient);
        $this->imageFactory = new ImageFactory($httpClient);

        parent::__construct($httpClient);
    }

    #[\Override]
    public function createCollection(array $data = []): GenericCollection
    {
        $collection = new GenericCollection();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): Collection
    {
        $collection = new Collection();

        if (\array_key_exists('parts', $data)) {
            $collection->setParts(
                $this->getMovieFactory()->createCollection($data['parts']),
            );
        }

        if (\array_key_exists('backdrop_path', $data)) {
            $collection->setBackdropImage(
                $this->getImageFactory()->createFromPath($data['backdrop_path'], 'backdrop_path'),
            );
        }

        if (\array_key_exists('images', $data)) {
            $collection->setImages(
                $this->getImageFactory()->createCollectionFromMovie($data['images']),
            );
        }

        if (\array_key_exists('poster_path', $data)) {
            $collection->setPosterImage(
                $this->getImageFactory()->createFromPath($data['poster_path'], 'poster_path'),
            );
        }

        /* Translations */
        if (\array_key_exists('translations', $data) && null !== $data['translations']) {
            if (\array_key_exists('translations', $data['translations'])) {
                $translations = $data['translations']['translations'];
            } else {
                $translations = $data['translations'];
            }

            $collection->setTranslations(
                $this->createGenericCollection($translations, new Translation()),
            );
        }

        return $this->hydrate($collection, $data);
    }

    /**
     * @return MovieFactory
     */
    public function getMovieFactory()
    {
        return $this->movieFactory;
    }

    /**
     * @param MovieFactory $movieFactory
     */
    public function setMovieFactory($movieFactory): static
    {
        $this->movieFactory = $movieFactory;

        return $this;
    }

    /**
     * @return ImageFactory
     */
    public function getImageFactory()
    {
        return $this->imageFactory;
    }

    /**
     * @param ImageFactory $imageFactory
     */
    public function setImageFactory($imageFactory): static
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }
}
