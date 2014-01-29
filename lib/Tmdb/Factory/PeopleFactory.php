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

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;
use Tmdb\Model\Person;

class PeopleFactory extends AbstractFactory {
    /**
     * @var ImageFactory
     */
    private $imageFactory;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imageFactory = new ImageFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data = array(), Person\AbstractMember $person = null)
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

        /** Images */
        if (array_key_exists('images', $data)) {
            $person->setImages($this->getImageFactory()->createCollectionFromPeople($data['images']));
        }

        if (array_key_exists('profile_path', $data)) {
            $person->setProfile($this->getImageFactory()->createFromPath($data['profile_path'], 'profile_path'));
        }

        return $this->hydrate($person, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = array(), Person\AbstractMember $person = null)
    {
        $collection = new GenericCollection();

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach($data as $item) {
            $collection->add(null, $this->create($item, $person));
        }

        return $collection;
    }

    /**
     * @param \Tmdb\Factory\ImageFactory $imageFactory
     * @return $this
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\ImageFactory
     */
    public function getImageFactory()
    {
        return $this->imageFactory;
    }
}
