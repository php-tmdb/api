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

namespace Tmdb\Model;

use DateTime;
use DateTimeZone;
use Tmdb\Model\Collection\CreditsCollection\CombinedCredits;
use Tmdb\Model\Collection\CreditsCollection\MovieCredits;
use Tmdb\Model\Collection\CreditsCollection\TvCredits;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\People\PersonInterface;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\ProfileImage;

/**
 * Class Person.
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
        'popularity',
    ];

    /**
     * @var GenericCollection|mixed
     */
    protected $knownFor;

    /**
     * @var MovieCredits|mixed
     */
    protected $movieCredits;

    /**
     * @var TvCredits|mixed
     */
    protected $tvCredits;

    /**
     * @var CombinedCredits|mixed
     */
    protected $combinedCredits;

    /**
     * @var Images|mixed
     */
    protected $images;

    /**
     * @var GenericCollection
     */
    protected $changes;

    /**
     * External Ids.
     * @var ExternalIds|mixed
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
    private array $alsoKnownAs = [];
    /**
     * @var string
     */
    private $biography;
    /**
     * @var DateTime
     */
    private $birthday;
    /**
     * @var DateTime|bool
     */
    private $deathday;
    /**
     * @var string
     */
    private $homepage;
    private ?int $id = null;

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
    private ?string $imdbId = null;
    private ?\Tmdb\Model\Image\ProfileImage $profileImage = null;
    /**
     * @var float
     */
    private $popularity;

    /**
     * Constructor.
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
     * @return bool
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param bool $adult
     */
    public function setAdult($adult): static
    {
        $this->adult = $adult;

        return $this;
    }

    public function getAlsoKnownAs()
    {
        return $this->alsoKnownAs;
    }

    /**
     * @param array $alsoKnownAs
     */
    public function setAlsoKnownAs($alsoKnownAs): static
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
     */
    public function setBiography($biography): static
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

    public function setBirthday($birthday): static
    {
        if (!$birthday instanceof DateTime && !empty($birthday)) {
            if (ctype_digit((string) $birthday) && 4 === \strlen($birthday)) {
                $birthday = DateTime::createFromFormat(
                    'Y-m-d',
                    \sprintf('%d-01-01', $birthday),
                    new DateTimeZone('UTC'),
                );
            } elseif (false === strtotime((string) $birthday)) {
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

    public function setChanges(GenericCollection $changes): static
    {
        $this->changes = $changes;

        return $this;
    }

    public function getDeathday()
    {
        return $this->deathday;
    }

    public function setDeathday($deathday): static
    {
        if (!$deathday instanceof DateTime && !empty($deathday)) {
            if (ctype_digit((string) $deathday) && 4 === \strlen($deathday)) {
                $deathday = DateTime::createFromFormat(
                    'Y-m-d',
                    \sprintf('%d-01-01', $deathday),
                    new DateTimeZone('UTC'),
                );
            } elseif (false === strtotime((string) $deathday)) {
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
     */
    public function setHomepage($homepage): static
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * @return int
     */
    #[\Override]
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): static
    {
        $this->id = (int) $id;

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
     */
    public function setImages($images): static
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return string
     */
    #[\Override]
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $knownForDepartment
     */
    public function setKnownForDepartment($knownForDepartment): static
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
     */
    public function setName($name): static
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
     */
    public function setPlaceOfBirth($placeOfBirth): static
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
     */
    public function setProfilePath($profilePath): static
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

    public function setProfileImage(ProfileImage $profileImage): static
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
     */
    public function setCombinedCredits($combinedCredits): static
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
     */
    public function setMovieCredits($movieCredits): static
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
     */
    public function setTvCredits($tvCredits): static
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
     */
    public function setExternalIds($externalIds): static
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
     */
    public function setTaggedImages($taggedImages): static
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
     */
    public function setKnownFor($knownFor): static
    {
        $this->knownFor = $knownFor;

        return $this;
    }

    public function isMale(): bool
    {
        return 2 === $this->gender;
    }

    public function isFemale(): bool
    {
        return 1 === $this->gender;
    }

    public function isUnknownGender(): bool
    {
        return 0 === $this->gender;
    }

    /**
     * @param int $gender
     */
    public function setGender($gender): void
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
    public function setPopularity($popularity): void
    {
        $this->popularity = $popularity;
    }

    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    public function setImdbId(?string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }
}
