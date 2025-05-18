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

use RuntimeException;
use Tmdb\Api\Search;
use Tmdb\Client;
use Tmdb\Exception\NotImplementedException;
use Tmdb\Factory\CollectionFactory;
use Tmdb\Factory\CompanyFactory;
use Tmdb\Factory\KeywordFactory;
use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Factory\TvFactory;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Company;
use Tmdb\Model\Keyword;
use Tmdb\Model\Movie;
use Tmdb\Model\Person;
use Tmdb\Model\Search\SearchQuery;
use Tmdb\Model\Search\SearchQuery\CollectionSearchQuery;
use Tmdb\Model\Search\SearchQuery\CompanySearchQuery;
use Tmdb\Model\Search\SearchQuery\KeywordSearchQuery;
use Tmdb\Model\Search\SearchQuery\MovieSearchQuery;
use Tmdb\Model\Search\SearchQuery\PersonSearchQuery;
use Tmdb\Model\Search\SearchQuery\TvSearchQuery;
use Tmdb\Model\Tv;

/**
 * Class SearchRepository.
 *
 * @see http://docs.themoviedb.apiary.io/#search
 */
class SearchRepository extends AbstractRepository
{
    /**
     * @var MovieFactory|mixed
     */
    protected $movieFactory;

    /**
     * @var CollectionFactory|mixed
     */
    protected $collectionFactory;

    /**
     * @var TvFactory|mixed
     */
    protected $tvFactory;

    /**
     * @var PeopleFactory|mixed
     */
    protected $peopleFactory;

    /**
     * @var CompanyFactory|mixed
     */
    protected $companyFactory;

    /**
     * @var KeywordFactory|mixed
     */
    protected $keywordFactory;

    public function __construct(Client $client)
    {
        parent::__construct($client);

        $this->movieFactory = new MovieFactory($this->getClient()->getHttpClient());
        $this->collectionFactory = new CollectionFactory($this->getClient()->getHttpClient());
        $this->tvFactory = new TvFactory($this->getClient()->getHttpClient());
        $this->peopleFactory = new PeopleFactory($this->getClient()->getHttpClient());
        $this->companyFactory = new CompanyFactory($this->getClient()->getHttpClient());
        $this->keywordFactory = new KeywordFactory($this->getClient()->getHttpClient());
    }

    /**
     * @param string $query
     *
     * @return ResultCollection|Movie[]
     */
    public function searchMovie($query, MovieSearchQuery $parameters, array $headers = []): \Tmdb\Model\Collection\ResultCollection
    {
        $data = $this->getApi()->searchMovies($query, $this->getParameters($parameters), $headers);

        return $this->getMovieFactory()->createResultCollection($data);
    }

    /**
     * Return the related API class.
     *
     * @return Search
     */
    #[\Override]
    public function getApi()
    {
        return $this->getClient()->getSearchApi();
    }

    /**
     * Convert parameters back to an array.
     *
     * @param SearchQuery|array $parameters
     *
     * @return array
     */
    private function getParameters($parameters = [])
    {
        if ($parameters instanceof SearchQuery) {
            return $parameters->toArray();
        }

        return $parameters;
    }

    /**
     * @return MovieFactory
     */
    public function getMovieFactory()
    {
        return $this->movieFactory;
    }

    /**
     * @param MovieFactory $movieFactory
     */
    public function setMovieFactory($movieFactory): static
    {
        $this->movieFactory = $movieFactory;

        return $this;
    }

    /**
     * @param string $query
     */
    public function searchCollection($query, CollectionSearchQuery $parameters, array $headers = []): \Tmdb\Model\Collection\ResultCollection
    {
        $data = $this->getApi()->searchCollection($query, $this->getParameters($parameters), $headers);

        return $this->getCollectionFactory()->createResultCollection($data);
    }

    /**
     * @return CollectionFactory
     */
    public function getCollectionFactory()
    {
        return $this->collectionFactory;
    }

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function setCollectionFactory($collectionFactory): static
    {
        $this->collectionFactory = $collectionFactory;

        return $this;
    }

    /**
     * @param string $query
     *
     * @return ResultCollection|Tv[]
     */
    public function searchTv($query, TvSearchQuery $parameters, array $headers = []): \Tmdb\Model\Collection\ResultCollection
    {
        $data = $this->getApi()->searchTv($query, $this->getParameters($parameters), $headers);

        return $this->getTvFactory()->createResultCollection($data);
    }

    /**
     * @return TvFactory
     */
    public function getTvFactory()
    {
        return $this->tvFactory;
    }

    /**
     * @param TvFactory $tvFactory
     */
    public function setTvFactory($tvFactory): static
    {
        $this->tvFactory = $tvFactory;

        return $this;
    }

    /**
     * @param string $query
     *
     * @return ResultCollection|Person[]
     */
    public function searchPerson($query, PersonSearchQuery $parameters, array $headers = []): \Tmdb\Model\Collection\ResultCollection
    {
        $data = $this->getApi()->searchPersons($query, $this->getParameters($parameters), $headers);

        return $this->getPeopleFactory()->createResultCollection($data);
    }

    /**
     * @return PeopleFactory
     */
    public function getPeopleFactory()
    {
        return $this->peopleFactory;
    }

    /**
     * @param PeopleFactory $peopleFactory
     */
    public function setPeopleFactory($peopleFactory): static
    {
        $this->peopleFactory = $peopleFactory;

        return $this;
    }

    /**
     * @return ResultCollection|Company[]
     */
    public function searchCompany(string $query, CompanySearchQuery $parameters, array $headers = []): \Tmdb\Model\Collection\ResultCollection
    {
        $data = $this->getApi()->searchCompany($query, $this->getParameters($parameters), $headers);

        return $this->getCompanyFactory()->createResultCollection($data);
    }

    /**
     * @return CompanyFactory
     */
    public function getCompanyFactory()
    {
        return $this->companyFactory;
    }

    /**
     * @param CompanyFactory $companyFactory
     */
    public function setCompanyFactory($companyFactory): static
    {
        $this->companyFactory = $companyFactory;

        return $this;
    }

    /**
     * @param string $query
     *
     * @return ResultCollection|Keyword[]
     */
    public function searchKeyword($query, KeywordSearchQuery $parameters, array $headers = []): \Tmdb\Model\Collection\ResultCollection
    {
        $data = $this->getApi()->searchKeyword($query, $this->getParameters($parameters), $headers);

        return $this->getKeywordFactory()->createResultCollection($data);
    }

    /**
     * @return KeywordFactory
     */
    public function getKeywordFactory()
    {
        return $this->keywordFactory;
    }

    /**
     * @param KeywordFactory $keywordFactory
     */
    public function setKeywordFactory($keywordFactory): static
    {
        $this->keywordFactory = $keywordFactory;

        return $this;
    }

    /**
     * @param string $query
     *
     * @return ResultCollection|Keyword[]
     */
    public function searchMulti($query, KeywordSearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchMulti($query, $this->getParameters($parameters), $headers);
        $collection = new ResultCollection();

        if (null === $data) {
            return $collection;
        }

        if (\array_key_exists('page', $data)) {
            $collection->setPage($data['page']);
        }

        if (\array_key_exists('total_pages', $data)) {
            $collection->setTotalPages($data['total_pages']);
        }

        if (\array_key_exists('total_results', $data)) {
            $collection->setTotalResults($data['total_results']);
        }

        if (\array_key_exists('results', $data)) {
            foreach ($data['results'] as $item) {
                if ($item) {
                    $collection->add(null, $this->processSearchMultiItem($item));
                }
            }
        }

        return $collection;
    }

    /**
     * Process multi search items.
     *
     * @return \Tmdb\Model\AbstractModel|false|null
     *
     * @throws RuntimeException
     */
    private function processSearchMultiItem(array $item)
    {
        if (\array_key_exists('media_type', $item)) {
            return match ($item['media_type']) {
                'movie' => $this->getMovieFactory()->create($item),
                'tv' => $this->getTvFactory()->create($item),
                'person' => $this->getPeopleFactory()->create($item),
                default => throw new RuntimeException(\sprintf('Could not process media_type "%s" in multi search, type unknown.', $item['media_type'])),
            };
        }

        return false;
    }

    /**
     * SearchRepository does not support a generic factory.
     *
     * @throws NotImplementedException
     */
    #[\Override]
    public function getFactory(): void
    {
        throw new NotImplementedException('SearchRepository does not support a generic factory.');
    }
}
