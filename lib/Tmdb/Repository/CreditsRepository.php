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

use Tmdb\Api\Credits;
use Tmdb\Factory\CreditsFactory;

/**
 * Class CreditsRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#credits
 */
class CreditsRepository extends AbstractRepository
{
    /**
     * Load a company with the given identifier.
     */
    public function load(string $id, array $parameters = [], array $headers = []): \Tmdb\Model\Credits
    {
        $data = $this->getApi()->getCredit($id, $this->parseQueryParameters($parameters), $headers);

        return $this->getFactory()->create($data);
    }

    /**
     * Return the related API class.
     *
     * @return Credits
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getCreditsApi();
    }

    #[\Override]
    public function getFactory(): \Tmdb\Factory\CreditsFactory
    {
        return new CreditsFactory($this->getClient()->getHttpClient());
    }
}
