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

use Tmdb\Api\Keywords;
use Tmdb\Factory\KeywordFactory;
use Tmdb\Factory\MovieFactory;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Keyword;

/**
 * Class KeywordRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#keywords
 */
class KeywordRepository extends AbstractRepository
{
    /**
     * Get the basic information for a specific keyword id.
     */
    public function load($id, array $parameters = [], array $headers = []): \Tmdb\Model\Keyword
    {
        return $this->getFactory()->create(
            $this->getApi()->getKeyword($id, $parameters, $headers),
        );
    }

    #[\Override]
    public function getFactory(): \Tmdb\Factory\KeywordFactory
    {
        return new KeywordFactory($this->getClient()->getHttpClient());
    }

    public function getMovieFactory(): \Tmdb\Factory\MovieFactory
    {
        return new MovieFactory($this->getClient()->getHttpClient());
    }

    /**
     * Return the related API class.
     *
     * @return Keywords
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getKeywordsApi();
    }

    /**
     * Get the list of movies for a particular keyword by id.
     * By default, only movies with 10 or more votes are included.
     *
     * @return ResultCollection|Keyword[]
     */
    public function getMovies($id, array $parameters = [], array $headers = []): \Tmdb\Model\Collection\ResultCollection
    {
        return $this->getMovieFactory()->createResultCollection(
            $this->getApi()->getMovies($id, $parameters, $headers),
        );
    }
}
