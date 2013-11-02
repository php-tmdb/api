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

class Image extends AbstractModel {

    const FORMAT_POSTER   = 'poster';
    const FORMAT_BACKDROP = 'backdrop';
    const FORMAT_PROFILE  = 'profile';
    const FORMAT_LOGO     = 'logo';
    const FORMAT_STILL    = 'still';

    private $filePath;
    private $width;
    private $height;
    private $iso6391;
    private $aspectRatio;

    protected $id;
    protected $type;

    protected static $_properties = array(
        'file_path',
        'width',
        'height',
        'iso_639_1',
        'aspect_ratio'
    );

    protected static $_types = array(
        'posters'   => self::FORMAT_POSTER,
        'backdrops' => self::FORMAT_BACKDROP,
        'profiles'  => self::FORMAT_PROFILE,
        'logos'     => self::FORMAT_LOGO,
        'stills'    => self::FORMAT_STILL
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
        $image = new Image();
        //$image->setClient($client);

        return $image->hydrate($data);
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
     * Get the singular type as defined in $_types
     *
     * @param $name
     * @return mixed
     */
    public static function getTypeFromCollectionName($name)
    {
        if (array_key_exists($name, self::$_types)) {
            return self::$_types[$name];
        }
    }

    /**
     * @param mixed $aspectRatio
     * @return $this
     */
    public function setAspectRatio($aspectRatio)
    {
        $this->aspectRatio = $aspectRatio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAspectRatio()
    {
        return $this->aspectRatio;
    }

    /**
     * @param mixed $filePath
     * @return $this
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param mixed $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
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
     * @param mixed $iso6391
     * @return $this
     */
    public function setIso6391($iso6391)
    {
        $this->iso6391 = $iso6391;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param mixed $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }


}