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

namespace Tmdb\Model;

use DateTime;
use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\CreditsCollection\CombinedCredits;
use Tmdb\Model\Collection\CreditsCollection\MovieCredits;
use Tmdb\Model\Collection\CreditsCollection\TvCredits;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\People\PersonInterface;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\ProfileImage;

/**
 * Class Person
 * @package Tmdb\Model
 */
class Person extends AbstractModel implements PersonInterface
{
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
        'imdb_id',
        'popularity'
    ];

    /**
     * @var Common\GenericCollection
     */
    protected $knownFor;
    /**
     * @var MovieCredits
     */
    protected $movieCredits;
    /**
     * @var TvCredits
     */
    protected $tvCredits;
    /**
     * @var CombinedCredits
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
     * @var DateTime
     */
    private $birthday;
    /**
     * @var DateTime|boolean
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
    private $knownForDepartment;

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
     * @var string|null
     */
    private $imdbId;
    /**
     * @var ProfileImage
     */
    private $profileImage;
    /**
     * @var float
     */
    private $popularity;

    /**
     * Constructor
     *
     * Set all default collections
     */
    public function __construct()
    {
        $this->movieCredits = new MovieCredits();
        $this->tvCredits = new TvCredits();
        $this->combinedCredits = new CombinedCredits();
        $this->images = new Images();
        $this->changes = new GenericCollection();
        $this->externalIds = new ExternalIds();
        $this->knownFor = new GenericCollection();
    }

    /**
     * @return boolean
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param boolean $adult
     * @return self
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;

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
     * @param array $alsoKnownAs
     * @return self
     */
    public function setAlsoKnownAs($alsoKnownAs)
    {
        $this->alsoKnownAs = $alsoKnownAs;

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
     * @param string $biography
     * @return self
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     * @return self
     */
    public function setBirthday($birthday)
    {
        if (!$birthday instanceof DateTime && !empty($birthday)) {
            if (ctype_digit($birthday) && strlen(4)) {
                $birthday = DateTime::createFromFormat(
                    'Y-m-d',
                    sprintf('%d-01-01', $birthday),
                    new \DateTimeZone('UTC')
                );
            } elseif (strtotime($birthday) === false) {
                $birthday = DateTime::createFromFormat('Y-d-m', $birthday);
            } else {
                $birthday = new DateTime($birthday);
            }
        }

        if (empty($birthday)) {
            $birthday = false;
        }

        $this->birthday = $birthday;

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
     * @param GenericCollection $changes
     * @return self
     */
    public function setChanges(GenericCollection $changes)
    {
        $this->changes = $changes;

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
     * @param mixed $deathday
     * @return self
     */
    public function setDeathday($deathday)
    {
        if (!$deathday instanceof DateTime && !empty($deathday)) {
            if (ctype_digit($deathday) && strlen(4)) {
                $deathday = DateTime::createFromFormat(
                    'Y-m-d',
                    sprintf('%d-01-01', $deathday),
                    new \DateTimeZone('UTC')
                );
            } elseif (strtotime($deathday) === false) {
                $deathday = DateTime::createFromFormat('Y-d-m', $deathday);
            } else {
                $deathday = new DateTime($deathday);
            }
        }

        if (empty($deathday)) {
            $deathday = false;
        }

        $this->deathday = $deathday;

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
     * @param string $homepage
     * @return self
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

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
     * @param mixed $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int)$id;

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
     * @param Images $images
     * @return self
     */
    public function setImages($images)
    {
        $this->images = $images;

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
     * @param  string $knownForDepartment
     * @return self
     */
    public function setKnownForDepartment($knownForDepartment)
    {
        $this->knownForDepartment = $knownForDepartment;

        return $this;
    }

    /**
     * @return string
     */
    public function getKnownForDepartment()
    {
        return $this->knownForDepartment;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @param string $placeOfBirth
     * @return self
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;

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
     * @param string $profilePath
     * @return self
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;

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
     * @param ProfileImage $profileImage
     * @return self
     */
    public function setProfileImage(ProfileImage $profileImage)
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    /**
     * @return CombinedCredits
     */
    public function getCombinedCredits()
    {
        return $this->combinedCredits;
    }

    /**
     * @param CombinedCredits $combinedCredits
     * @return self
     */
    public function setCombinedCredits($combinedCredits)
    {
        $this->combinedCredits = $combinedCredits;

        return $this;
    }

    /**
     * @return MovieCredits
     */
    public function getMovieCredits()
    {
        return $this->movieCredits;
    }

    /**
     * @param MovieCredits $movieCredits
     * @return self
     */
    public function setMovieCredits($movieCredits)
    {
        $this->movieCredits = $movieCredits;

        return $this;
    }

    /**
     * @return TvCredits
     */
    public function getTvCredits()
    {
        return $this->tvCredits;
    }

    /**
     * @param TvCredits $tvCredits
     * @return self
     */
    public function setTvCredits($tvCredits)
    {
        $this->tvCredits = $tvCredits;

        return $this;
    }

    /**
     * @return ExternalIds
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    /**
     * @param ExternalIds $externalIds
     * @return self
     */
    public function setExternalIds($externalIds)
    {
        $this->externalIds = $externalIds;

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
     * @param GenericCollection $taggedImages
     * @return self
     */
    public function setTaggedImages($taggedImages)
    {
        $this->taggedImages = $taggedImages;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getKnownFor()
    {
        return $this->knownFor;
    }

    /**
     * @param GenericCollection $knownFor
     * @return self
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
     *
     * @return void
     */
    public function setGender($gender): void
    {
        $this->gender = (int)$gender;
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
     *
     * @return void
     */
    public function setPopularity($popularity): void
    {
        $this->popularity = $popularity;
    }

    /**
     * @return string|null
     */
    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    /**
     * @param string|null $imdbId
     */
    public function setImdbId(?string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }
}
