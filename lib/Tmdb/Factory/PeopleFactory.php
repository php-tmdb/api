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

namespace Tmdb\Factory;

use Tmdb\Common\ObjectHydrator;
use Tmdb\Factory\Common\ChangeFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Collection\People;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image;
use Tmdb\Model\Image\BackdropImage;
use Tmdb\Model\Image\LogoImage;
use Tmdb\Model\Image\PosterImage;
use Tmdb\Model\Image\ProfileImage;
use Tmdb\Model\Image\StillImage;
use Tmdb\Model\Person;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;

class PeopleFactory extends AbstractFactory
{
    /**
     * @var ImageFactory
     */
    private $imageFactory;

    /**
     * @var ChangeFactory
     */
    private $changeFactory;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->imageFactory = new ImageFactory($httpClient);
        $this->changeFactory = new ChangeFactory($httpClient);

        parent::__construct($httpClient);
    }

    /**
     * {@inheritdoc}
     * @param Person\AbstractMember|null $person
     * @param People|null $collection
     */
    public function createCollection(array $data = [], $person = null, $collection = null): People
    {
        if (!$collection) {
            $collection = new People();
        }

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        if (is_object($person)) {
            $class = get_class($person);
        } else {
            $class = '\Tmdb\Model\Person';
        }

        foreach ($data as $item) {
            $collection->add(null, $this->create($item, new $class()));
        }

        return $collection;
    }

    /**
     * @param array $data
     * @param Person\AbstractMember|null $person
     *
     * @return Person
     */
    public function create(array $data = [], $person = null)
    {
        if (!is_object($person)) {
            if (array_key_exists('character', $data)) {
                $person = new CastMember();
            }

            if (array_key_exists('job', $data)) {
                $person = new CrewMember();
            }

            if (null === $person) {
                $person = new Person();
            }
        }

        if (array_key_exists('profile_path', $data)) {
            $person->setProfileImage($this->getImageFactory()->createFromPath($data['profile_path'], 'profile_path'));
        }

        if ($person instanceof Person) {
            /** Images */
            if (array_key_exists('images', $data)) {
                $person->setImages($this->getImageFactory()->createCollectionFromPeople($data['images']));
            }

            if (array_key_exists('changes', $data)) {
                $person->setChanges($this->getChangeFactory()->createCollection($data['changes']));
            }

            /** External ids */
            if (array_key_exists('external_ids', $data)) {
                $person->setExternalIds(
                    $this->hydrate(new ExternalIds(), $data['external_ids'])
                );
            }

            if (array_key_exists('tagged_images', $data)) {
                $person->setTaggedImages(
                    $this->getImageFactory()->createResultCollection(
                        $data['tagged_images'],
                        'createMediaImage'
                    )
                );
            }

            /** External ids */
            if (array_key_exists('known_for', $data)) {
                $person->setKnownFor(
                    $this->createGenericCollectionFromMediaTypes($data['known_for'])
                );
            }

            /** Credits */
            $this->applyCredits($data, $person);
        }

        return $this->hydrate($person, $data);
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
     * @return self
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }

    /**
     * @return ChangeFactory
     */
    public function getChangeFactory()
    {
        return $this->changeFactory;
    }

    /**
     * @param ChangeFactory $changeFactory
     * @return self
     */
    public function setChangeFactory($changeFactory)
    {
        $this->changeFactory = $changeFactory;

        return $this;
    }

    /**
     * Apply credits
     *
     * @param array $data
     * @param Person $person
     *
     * @return void
     */
    protected function applyCredits(array $data, Person $person): void
    {
        $hydrator = new ObjectHydrator();
        $types = ['movie_credits', 'tv_credits', 'combined_credits'];

        foreach ($types as $type) {
            if (array_key_exists($type, $data)) {
                $method = $hydrator->camelize(sprintf('get_%s', $type));

                if (array_key_exists('cast', $data[$type])) {
                    $cast = $this->createCustomCollection(
                        $data[$type]['cast'],
                        new Person\Credit(),
                        new People\Cast()
                    );

                    foreach ($cast as $member) {
                        $member->setPosterImage($this->getPosterImageForCredit($member->getPosterPath()));
                    }

                    $person->$method()->setCast($cast);
                }

                if (array_key_exists('crew', $data[$type])) {
                    $crew = $this->createCustomCollection(
                        $data[$type]['crew'],
                        new Person\Credit(),
                        new People\Crew()
                    );

                    foreach ($crew as $member) {
                        $member->setPosterImage($this->getPosterImageForCredit($member->getPosterPath()));
                    }

                    $person->$method()->setCrew($crew);
                }
            }
        }
    }

    /**
     * @return Image|BackdropImage|LogoImage|PosterImage|ProfileImage|StillImage
     */
    protected function getPosterImageForCredit($posterPath)
    {
        return $this->getImageFactory()->createFromPath($posterPath, 'poster_path');
    }
}
