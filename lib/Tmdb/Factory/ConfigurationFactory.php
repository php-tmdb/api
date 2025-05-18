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

namespace Tmdb\Factory;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Configuration;

/**
 * Class ConfigurationFactory.
 */
class ConfigurationFactory extends AbstractFactory
{
    #[\Override]
    public function create(array $data = []): Configuration
    {
        $config = new Configuration();

        return $this->hydrate($config, $data);
    }

    #[\Override]
    public function createCollection(array $data = []): GenericCollection
    {
        return new GenericCollection();
    }
}
