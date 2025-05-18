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

namespace Tmdb\Model\Person;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Image;

/**
 * Class AbstractMember.
 */
abstract class AbstractMember extends AbstractModel
{
    public static $properties = [
        'id',
        'name',
        'profile_path',
    ];
    private ?int $id = null;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $profilePath;
    /**
     * @var ?Image\ProfileImage
     */
    private $profile;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int) $id;

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
     * @param string $name
     *
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
    public function getProfilePath()
    {
        return $this->profilePath;
    }

    /**
     * @param string $profilePath
     *
     * @return self
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;

        return $this;
    }

    /**
     * @param Image\ProfileImage $profile
     *
     * @return self
     */
    public function setProfileImage($profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Image\ProfileImage
     */
    public function getProfileImage()
    {
        return $this->profile;
    }

    /**
     * Assert if there is an profile image object.
     *
     * @return bool
     */
    public function hasProfileImage()
    {
        return $this->profile instanceof Image;
    }
}
