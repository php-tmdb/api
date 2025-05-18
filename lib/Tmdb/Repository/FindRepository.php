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

use Tmdb\Factory\FindFactory;
use Tmdb\Model\Find;

/**
 * Class FindRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#find
 */
class FindRepository extends AbstractRepository
{
    /**
     * Find something.
     */
    public function findBy(string $id, array $parameters = [], array $headers = []): \Tmdb\Model\Find
    {
        return $this->getFactory()->create(
            $this->getApi()->findBy($id, $parameters, $headers),
        );
    }

    #[\Override]
    public function getFactory(): \Tmdb\Factory\FindFactory
    {
        return new FindFactory($this->getClient()->getHttpClient());
    }

    /**
     * Return the related API class.
     *
     * @return \Tmdb\Api\Find
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getFindApi();
    }
}
