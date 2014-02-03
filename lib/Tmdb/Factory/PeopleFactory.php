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

use Tmdb\Common\ObjectHydrator;
use Tmdb\Factory\People\CastFactory;
use Tmdb\Factory\People\CrewFactory;
use Tmdb\Model\Collection\People\Cast;
use Tmdb\Model\Collection\People\Crew;
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
     * @var People\CastFactory
     */
    private $castFactory;

    /**
     * @var People\CrewFactory
     */
    private $crewFactory;

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

        /** Credits */
        if ($person instanceof Person) {
            $this->applyCredits($data, $person);
        }

        return $this->hydrate($person, $data);
    }

    /**
     * Apply credits
     *
     * @param array $data
     * @param Person $person
     */
    protected function applyCredits(array $data = array(), Person $person) {
        $hydrator = new ObjectHydrator();
        $types    = array('movie_credits', 'tv_credits', 'combined_credits');

        foreach($types as $type) {
            if (array_key_exists($type, $data)) {
                $method = $hydrator->camelize(sprintf('get_%s', $type));

                if (array_key_exists('cast', $data[$type])) {
                    $person->$method()->setCast($this->createCollection(
                        $data[$type]['cast'],
                        new CastMember(),
                        new Cast())
                    );
                }

                if (array_key_exists('crew', $data[$type])) {
                    $person->$method()->setCrew($this->createCollection(
                        $data[$type]['crew'],
                        new CrewMember(),
                        new Crew())
                    );
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = array(), Person\AbstractMember $person = null, $collection = null)
    {
        if (!$collection) {
            $collection = new GenericCollection();
        }

        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }

        foreach($data as $item) {
            $collection->add(null, $this->create($item, $person));
        }

        return $collection;
    }

    /**
     * @param \Tmdb\Factory\People\CastFactory $castFactory
     * @return $this
     */
    public function setCastFactory($castFactory)
    {
        $this->castFactory = $castFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\People\CastFactory
     */
    public function getCastFactory()
    {
        return $this->castFactory;
    }

    /**
     * @param \Tmdb\Factory\People\CrewFactory $crewFactory
     * @return $this
     */
    public function setCrewFactory($crewFactory)
    {
        $this->crewFactory = $crewFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\People\CrewFactory
     */
    public function getCrewFactory()
    {
        return $this->crewFactory;
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
