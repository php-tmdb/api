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
namespace Tmdb\Model;

use Tmdb\Client;

class Person extends AbstractModel {

    private $adult;
    private $alsoKnownAs = array();
    private $biography;
    private $birthday;
    private $deathday;
    private $homepage;
    private $id;
    private $name;
    private $department;
    private $job;
    private $placeOfBirth;
    private $profilePath;

    protected $credits;
    protected $images;
    protected $changes;

    protected static $_properties = array(
        'adult',
        'also_known_as',
        'biography',
        'birthday',
        'deathday',
        'homepage',
        'id',
        'name',
        'place_of_birth',
        'profile_path',
    );

    /**
     * Convert an array to an hydrated object
     *
     * @param Client $client
     * @param array $data
     * @return $this
     */
    public static function fromArray(Client $client, array $data)
    {
        $person = new Person($data['id']);
        //$person->setClient($client);

        if (array_key_exists('images', $data)) {
            $data['images'] = parent::collectImages($client, $data['images']);
        }

        return $person->hydrate($data);
    }

    /**
     * Load a person with the given identifier
     *
     * @param Client $client
     * @param $id
     * @param $with
     * @return $this
     */
    public static function load(Client $client, $id, array $with = array()) {
        $data = $client->api('people')->getPerson($id, $with);

        return Person::fromArray($client, $data);
    }

    /**
     * @param mixed $adult
     * @return $this
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param mixed $alsoKnownAs
     * @return $this
     */
    public function setAlsoKnownAs($alsoKnownAs)
    {
        $this->alsoKnownAs = $alsoKnownAs;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlsoKnownAs()
    {
        return $this->alsoKnownAs;
    }

    /**
     * @param mixed $biography
     * @return $this
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param mixed $birthday
     * @return $this
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $changes
     * @return $this
     */
    public function setChanges($changes)
    {
        $this->changes = $changes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * @param mixed $credits
     * @return $this
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param mixed $deathday
     * @return $this
     */
    public function setDeathday($deathday)
    {
        $this->deathday = $deathday;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeathday()
    {
        return $this->deathday;
    }

    /**
     * @param mixed $homepage
     * @return $this
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $images
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $placeOfBirth
     * @return $this
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * @param mixed $profilePath
     * @return $this
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfilePath()
    {
        return $this->profilePath;
    }

    /**
     * @param mixed $department
     * @return $this
     */
    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $job
     * @return $this
     */
    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

}