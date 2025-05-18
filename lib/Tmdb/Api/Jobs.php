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

namespace Tmdb\Api;

/**
 * Class Jobs.
 *
 * @see http://docs.themoviedb.apiary.io/#jobs
 */
class Jobs extends AbstractApi
{
    /**
     * Get a list of valid jobs.
     */
    public function getJobs(array $parameters = [], array $headers = []): array
    {
        return $this->get('job/list', $parameters, $headers);
    }
}
