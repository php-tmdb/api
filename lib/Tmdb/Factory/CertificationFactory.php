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

use Tmdb\Model\Certification;
use Tmdb\Model\Common\GenericCollection;

class CertificationFactory extends AbstractFactory
{
    /**
     * @param array $data
     *
     * @return Certification
     */
    public function create(array $data = array())
    {
        return $this->hydrate(new Certification\CountryCertification(), $data);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = array())
    {
        if (array_key_exists('certifications', $data)) {
            $data = $data['certifications'];
        }

        $collection = new GenericCollection();

        foreach($data as $country => $certifications) {
            $certification = new Certification();
            $certification->setCountry($country);

            foreach($certifications as $countryCertification) {
                $object = $this->create($countryCertification);

                $certification->getCertifications()->add(null, $object);
            }

            $collection->add(null, $certification);
        }

        return $collection;
    }

    /**
     * @param \Tmdb\Factory\TvEpisodeFactory $tvEpisodeFactory
     * @return $this
     */
    public function setTvEpisodeFactory($tvEpisodeFactory)
    {
        $this->tvEpisodeFactory = $tvEpisodeFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\TvEpisodeFactory
     */
    public function getTvEpisodeFactory()
    {
        return $this->tvEpisodeFactory;
    }

    /**
     * @param \Tmdb\Factory\TvSeasonFactory $tvSeasonFactory
     * @return $this
     */
    public function setTvSeasonFactory($tvSeasonFactory)
    {
        $this->tvSeasonFactory = $tvSeasonFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\TvSeasonFactory
     */
    public function getTvSeasonFactory()
    {
        return $this->tvSeasonFactory;
    }

    /**
     * @param \Tmdb\Factory\PeopleFactory $peopleFactory
     * @return $this
     */
    public function setPeopleFactory($peopleFactory)
    {
        $this->peopleFactory = $peopleFactory;
        return $this;
    }

    /**
     * @return \Tmdb\Factory\PeopleFactory
     */
    public function getPeopleFactory()
    {
        return $this->peopleFactory;
    }
}
