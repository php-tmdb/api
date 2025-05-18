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

namespace Tmdb\Common;

use Tmdb\Exception\RuntimeException;
use Tmdb\Model\AbstractModel;

/**
 * Utilisation class to hydrate objects.
 *
 * Class ObjectHydrator
 */
class ObjectHydrator
{
    /**
     * Hydrate the object with data.
     *
     * @param array $data
     *
     *
     * @throws RuntimeException
     */
    public function hydrate(AbstractModel $object, $data = []): AbstractModel
    {
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (\in_array($k, $object::$properties, true)) {
                    $method = $this->camelize(
                        \sprintf('set_%s', $k),
                    );

                    if (!\is_callable([$object, $method])) {
                        throw new RuntimeException(\sprintf('Trying to call method "%s" on "%s" but it does not exist or is private.', $method, $object::class));
                    }
                    $object->{$method}($v);
                }
            }
        }

        return $object;
    }

    /**
     * Transforms an under_scored_string to a camelCasedOne.
     *
     * @see https://gist.github.com/troelskn/751517
     *
     * @param string $candidate
     */
    public function camelize($candidate): string
    {
        return lcfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode(
                            '_',
                            $candidate,
                        ),
                    ),
                ),
            ),
        );
    }
}
