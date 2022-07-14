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

namespace Tmdb\Factory\Account;

use Tmdb\Exception\InvalidArgumentException;
use Tmdb\Factory\AbstractFactory;
use Tmdb\Model\Account\Avatar\Gravatar;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class AvatarFactory
 * @package Tmdb\Factory\Account
 */
class AvatarFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = []): GenericCollection
    {
        // @todo 4.0.x double check on this bug
        if (array_key_exists(0, $data)) {
            $data = $data[0];
        }

        $collection = new GenericCollection();
        $collection->add(null, $this->create($data));

        return $collection;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws InvalidArgumentException
     *
     */
    public function create(array $data = [])
    {
        foreach ($data as $type => $content) {
            // @todo 4.0.x double check on this bug
            if (array_key_exists(0, $content)) {
                $content = array_shift($content);
            }

            switch ($type) {
                case "gravatar":
                    return $this->hydrate(new Gravatar(), $content);

                default:
                    throw new InvalidArgumentException(sprintf(
                        'The avatar type "%s" has not been defined in the factory "%s".',
                        $type,
                        __CLASS__
                    ));
            }
        }

        return null;
    }
}
