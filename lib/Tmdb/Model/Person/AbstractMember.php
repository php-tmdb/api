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
namespace Tmdb\Model\Person;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Image;

abstract class AbstractMember extends AbstractModel {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $profilePath;

    /**
     * @var Image\ProfileImage
     */
    private $profile;

    public static $_properties = array(
        'id',
        'name',
        'profile_path'
    );

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
     * @param Image\ProfileImage $profile
     * @return $this
     */
    public function setProfile($profile = null)
    {
        $this->profile = $profile;
        return $this;
    }

    /**
     * @return Image\ProfileImage|null
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
