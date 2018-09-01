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

use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\People\PersonInterface;
use Tmdb\Model\Image\ProfileImage;

/**
 * Class Person
 * @package Tmdb\Model
 */
class Person extends AbstractModel implements PersonInterface
{
    /**
     * @var bool
     */
    private $adult;

    /**
     * @var array
     */
    private $alsoKnownAs = [];

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
    private $profileImage;

    /**
     * @var float
     */
    private $popularity;

    /**
     * @var Common\GenericCollection
     */
    protected $knownFor;

    /**
     * @var CreditsCollection\MovieCredits
     */
    protected $movieCredits;

    /**
     * @var CreditsCollection\TvCredits
     */
    protected $tvCredits;

    /**
     * @var CreditsCollection\CombinedCredits
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

    /**
     * External Ids
     *
     * @var ExternalIds
     */
    protected $externalIds;

    /**
     * @var GenericCollection
     */
    protected $taggedImages;

    protected $gender = 0;

    public static $properties = [
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
        'gender',
        'popularity'
    ];

    /**
     * Constructor
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->movieCredits    = new CreditsCollection\MovieCredits();
        $this->tvCredits       = new CreditsCollection\TvCredits();
        $this->combinedCredits = new CreditsCollection\CombinedCredits();
        $this->images          = new Images();
        $this->changes         = new GenericCollection();
        $this->externalIds     = new ExternalIds();
        $this->knownFor        = new GenericCollection();
    }

    /**
     * @param  boolean $adult
     * @return $this
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param  array $alsoKnownAs
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
     * @param  string $biography
     * @return $this
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param  mixed $birthday
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
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param  GenericCollection $changes
     * @return $this
     */
    public function setChanges(GenericCollection $changes)
    {
        $this->changes = $changes;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * @param  mixed $deathday
     * @return $this
     */
    public function setDeathday($deathday)
    {
        if (!$deathday instanceof \DateTime && !empty($deathday)) {
        	// Is the format Y-m-d ?
        	if(strtotime($deathday) === false) {
        		$deathday = \DateTime::createFromFormat('Y-d-m', $deathday);
        	} else {
        		$deathday = new \DateTime($deathday);
        	}
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
     * @param  string $homepage
     * @return $this
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param  mixed $id
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
     * @param  Images $images
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
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $placeOfBirth
     * @return $this
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * @param  string $profilePath
     * @return $this
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getProfilePath()
    {
        return $this->profilePath;
    }

    /**
     * @param  ProfileImage $profileImage
     * @return $this
     */
    public function setProfileImage(ProfileImage $profileImage)
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    /**
     * @return ProfileImage
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * @param  \Tmdb\Model\Collection\CreditsCollection\CombinedCredits $combinedCredits
     * @return $this
     */
    public function setCombinedCredits($combinedCredits)
    {
        $this->combinedCredits = $combinedCredits;

        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\CreditsCollection\CombinedCredits
     */
    public function getCombinedCredits()
    {
        return $this->combinedCredits;
    }

    /**
     * @param  \Tmdb\Model\Collection\CreditsCollection\MovieCredits $movieCredits
     * @return $this
     */
    public function setMovieCredits($movieCredits)
    {
        $this->movieCredits = $movieCredits;

        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\CreditsCollection\MovieCredits
     */
    public function getMovieCredits()
    {
        return $this->movieCredits;
    }

    /**
     * @param  \Tmdb\Model\Collection\CreditsCollection\TvCredits $tvCredits
     * @return $this
     */
    public function setTvCredits($tvCredits)
    {
        $this->tvCredits = $tvCredits;

        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\CreditsCollection\TvCredits
     */
    public function getTvCredits()
    {
        return $this->tvCredits;
    }

    /**
     * @param  \Tmdb\Model\Common\ExternalIds $externalIds
     * @return $this
     */
    public function setExternalIds($externalIds)
    {
        $this->externalIds = $externalIds;

        return $this;
    }

    /**
     * @return \Tmdb\Model\Common\ExternalIds
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    /**
     * @param  GenericCollection $taggedImages
     * @return $this
     */
    public function setTaggedImages($taggedImages)
    {
        $this->taggedImages = $taggedImages;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTaggedImages()
    {
        return $this->taggedImages;
    }

    /**
     * @return GenericCollection
     */
    public function getKnownFor()
    {
        return $this->knownFor;
    }

    /**
     * @param  GenericCollection $knownFor
     * @return $this
     */
    public function setKnownFor($knownFor)
    {
        $this->knownFor = $knownFor;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMale()
    {
        return $this->gender === 2;
    }

    /**
     * @return bool
     */
    public function isFemale()
    {
        return $this->gender === 1;
    }

    /**
     * @return bool
     */
    public function isUnknownGender()
    {
        return $this->gender === 0;
    }

    /**
     * @param int $gender
     */
    public function setGender($gender)
    {
        $this->gender = (int) $gender;
    }

    /**
     * @return float
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @param float $popularity
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;
    }
}
