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

use Tmdb\Model\Collection\Credits;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\People\PersonInterface;
use Tmdb\Model\Image\ProfileImage;

class Person extends AbstractModel implements PersonInterface {

    /**
     * @var bool
     */
    private $adult;

    /**
     * @var array
     */
    private $alsoKnownAs = array();

    /**
     * @var string
     */
    private $biography;
    /**
     * @var \DateTime
     */
    private $birthday;

    /**
     * @var \DateTime|boolean
     */
    private $deathday;

    /**
     * @var string
     */
    private $homepage;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $placeOfBirth;

    /**
     * @var string
     */
    private $profilePath;

    /**
     * @var ProfileImage
     */
    private $profile;

    /**
     * @var Collection\Credits
     * @deprecated
     */
    protected $credits;

    /**
     * @var Credits\MovieCredits
     */
    protected $movieCredits;

    /**
     * @var Credits\TvCredits
     */
    protected $tvCredits;

    /**
     * @var Credits\CombinedCredits
     */
    protected $combinedCredits;

    /**
     * @var Collection\Images
     */
    protected $images;

    /**
     * @var Common\GenericCollection
     */
    protected $changes;

    public static $_properties = array(
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
     * Constructor
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->credits         = new Credits();
        $this->movieCredits    = new Credits\MovieCredits();
        $this->tvCredits       = new Credits\TvCredits();
        $this->combinedCredits = new Credits\CombinedCredits();
        $this->images          = new Images();
        $this->changes         = new GenericCollection();
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
        if (!$birthday instanceof \DateTime) {
            $birthday = new \DateTime($birthday);
        }

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
        if (!$deathday instanceof \DateTime && !empty($deathday)) {
            $deathday = new \DateTime($deathday);
        }

        if (empty($deathday)) {
            $deathday = false;
        }

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
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Images $images
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Images
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
     * @param ProfileImage  $profile
     * @return $this
     */
    public function setProfile(ProfileImage $profile)
    {
        $this->profile = $profile;
        return $this;
    }

    /**
     * @return ProfileImage
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param \Tmdb\Model\Collection\Credits\CombinedCredits $combinedCredits
     * @return $this
     */
    public function setCombinedCredits($combinedCredits)
    {
        $this->combinedCredits = $combinedCredits;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\Credits\CombinedCredits
     */
    public function getCombinedCredits()
    {
        return $this->combinedCredits;
    }

    /**
     * @param \Tmdb\Model\Collection\Credits\MovieCredits $movieCredits
     * @return $this
     */
    public function setMovieCredits($movieCredits)
    {
        $this->movieCredits = $movieCredits;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\Credits\MovieCredits
     */
    public function getMovieCredits()
    {
        return $this->movieCredits;
    }

    /**
     * @param \Tmdb\Model\Collection\Credits\TvCredits $tvCredits
     * @return $this
     */
    public function setTvCredits($tvCredits)
    {
        $this->tvCredits = $tvCredits;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\Credits\TvCredits
     */
    public function getTvCredits()
    {
        return $this->tvCredits;
    }
}
