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

namespace Tmdb\Repository;

use Tmdb\Factory\ConfigurationFactory;
use Tmdb\Model\Configuration;

/**
 * Class ConfigurationRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#configuration
 */
class ConfigurationRepository extends AbstractRepository
{
    /**
     * Load up TMDB Configuration.
     */
    public function load(array $headers = []): \Tmdb\Model\Configuration
    {
        $data = $this->getApi()->getConfiguration($headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the Movies API Class.
     *
     * @return \Tmdb\Api\Configuration
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getConfigurationApi();
    }

    #[\Override]
    public function getFactory(): \Tmdb\Factory\ConfigurationFactory
    {
        return new ConfigurationFactory($this->getClient()->getHttpClient());
    }
}
