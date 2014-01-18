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

class Company extends AbstractModel {

    private $description;
    private $headquarters;
    private $homepage;
    private $id;
    private $logoPath;
    private $name;
    private $parentCompany;

    public static $_properties = array(
        'description',
        'headquarters',
        'homepage',
        'id',
        'logo_path',
        'name',
        'parent_company'
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
        $genre = new Company($data['id']);
        //$genre->setClient($client);

        return $genre->hydrate($data);
    }

    /**
     * Load a company with the given identifier
     *
     * @param Client $client
     * @param $id
     * @param $options
     * @return $this
     */
    public static function load(Client $client, $id, array $options = array()) {
        $data = $client->api('companies')->getCompany($id, $options);

        return Company::fromArray($client, $data);
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $headquarters
     * @return $this
     */
    public function setHeadquarters($headquarters)
    {
        $this->headquarters = $headquarters;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeadquarters()
    {
        return $this->headquarters;
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
     * @param mixed $logoPath
     * @return $this
     */
    public function setLogoPath($logoPath)
    {
        $this->logoPath = $logoPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogoPath()
    {
        return $this->logoPath;
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
     * @param mixed $parentCompany
     * @return $this
     */
    public function setParentCompany($parentCompany)
    {
        $this->parentCompany = $parentCompany;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentCompany()
    {
        return $this->parentCompany;
    }


}