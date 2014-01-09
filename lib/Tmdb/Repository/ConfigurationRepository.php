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
namespace Tmdb\Repository;

use Tmdb\Factory\ConfigurationFactory;
use Tmdb\Model\Configuration;

class ConfigurationRepository extends AbstractRepository {

    /**
     * Load a movie with the given identifier
     *
     * @param $id
     * @param $parameters
     * @return Configuration
     */
    public function load($id = null, array $parameters = array()) {
        $data = $this->getApi()->getConfiguration();

        return ConfigurationFactory::create($data);
    }

    /**
     * If you obtained an movie model which is not completely hydrated, you can use this function.
     *
     * @todo store the previous given parameters so the same conditions apply to a refresh, and merge the new set
     *
     * @param array $parameters
     * @return Configuration
     */
    public function refresh(array $parameters = array()) {
        return $this->load(null, $parameters);
    }

    /**
     * Return the Movies API Class
     *
     * @return \Tmdb\Api\Configuration
     */
    public function getApi()
    {
        return $this->getClient()->getConfigurationApi();
    }

}