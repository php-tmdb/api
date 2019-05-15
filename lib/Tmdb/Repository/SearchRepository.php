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

use Tmdb\Client;
use Tmdb\Exception\NotImplementedException;
use Tmdb\Factory\CollectionFactory;
use Tmdb\Factory\CompanyFactory;
use Tmdb\Factory\KeywordFactory;
use Tmdb\Factory\Movie\ListItemFactory;
use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Factory\TvFactory;
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Company;
use Tmdb\Model\Keyword;
use Tmdb\Model\Movie;
use Tmdb\Model\Person;
use Tmdb\Model\Search\SearchQuery\CollectionSearchQuery;
use Tmdb\Model\Search\SearchQuery\CompanySearchQuery;
use Tmdb\Model\Search\SearchQuery\KeywordSearchQuery;
use Tmdb\Model\Search\SearchQuery\ListSearchQuery;
use Tmdb\Model\Search\SearchQuery\MovieSearchQuery;
use Tmdb\Model\Search\SearchQuery\PersonSearchQuery;
use Tmdb\Model\Search\SearchQuery\TvSearchQuery;
use Tmdb\Model\Search\SearchQuery;
use Tmdb\Model\Tv;

/**
 * Class SearchRepository
 * @package Tmdb\Repository
 * @see http://docs.themoviedb.apiary.io/#search
 */
class SearchRepository extends AbstractRepository
{
    /**
     * @var MovieFactory
     */
    private $movieFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var TvFactory
     */
    private $tvFactory;

    /**
     * @var PeopleFactory
     */
    private $peopleFactory;

    /**
     * @var ListItemFactory
     */
    private $listItemFactory;

    /**
     * @var CompanyFactory
     */
    private $companyFactory;

    /**
     * @var KeywordFactory
     */
    private $keywordFactory;

    public function __construct(Client $client)
    {
        parent::__construct($client);

        $this->movieFactory      = new MovieFactory($this->getClient()->getHttpClient());
        $this->collectionFactory = new CollectionFactory($this->getClient()->getHttpClient());
        $this->tvFactory         = new TvFactory($this->getClient()->getHttpClient());
        $this->peopleFactory     = new PeopleFactory($this->getClient()->getHttpClient());
        $this->listItemFactory   = new ListItemFactory($this->getClient()->getHttpClient());
        $this->companyFactory    = new CompanyFactory($this->getClient()->getHttpClient());
        $this->keywordFactory    = new KeywordFactory($this->getClient()->getHttpClient());
    }

    /**
     * @param string           $query
     * @param MovieSearchQuery $parameters
     * @param array            $headers
     *
     * @return ResultCollection|Movie[]
     */
    public function searchMovie($query, MovieSearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchMovies($query, $this->getParameters($parameters), $headers);

        return $this->getMovieFactory()->createResultCollection($data);
    }

    /**
     * @param string                $query
     * @param CollectionSearchQuery $parameters
     * @param array                 $headers
     *
     * @return ResultCollection
     */
    public function searchCollection($query, CollectionSearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchCollection($query, $this->getParameters($parameters), $headers);

        return $this->getCollectionFactory()->createResultCollection($data);
    }

    /**
     * @param string        $query
     * @param TvSearchQuery $parameters
     * @param array         $headers
     *
     * @return ResultCollection|Tv[]
     */
    public function searchTv($query, TvSearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchTv($query, $this->getParameters($parameters), $headers);

        return $this->getTvFactory()->createResultCollection($data);
    }

    /**
     * @param string            $query
     * @param PersonSearchQuery $parameters
     * @param array             $headers
     *
     * @return ResultCollection|Person[]
     */
    public function searchPerson($query, PersonSearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchPersons($query, $this->getParameters($parameters), $headers);

        return $this->getPeopleFactory()->createResultCollection($data);
    }

    /**
     * @param string          $query
     * @param ListSearchQuery $parameters
     * @param array           $headers
     *
     * @return ResultCollection
     */
    public function searchList($query, ListSearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchList($query, $this->getParameters($parameters), $headers);

        return $this->getListitemFactory()->createResultCollection($data);
    }

    /**
     * @param string             $query
     * @param CompanySearchQuery $parameters
     * @param array              $headers
     *
     * @return ResultCollection|Company[]
     */
    public function searchCompany($query, CompanySearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchCompany($query, $this->getParameters($parameters), $headers);

        return $this->getCompanyFactory()->createResultCollection($data);
    }

    /**
     * @param string             $query
     * @param KeywordSearchQuery $parameters
     * @param array              $headers
     *
     * @return ResultCollection|Keyword[]
     */
    public function searchKeyword($query, KeywordSearchQuery $parameters, array $headers = [])
    {
        $data = $this->getApi()->searchKeyword($query, $this->getParameters($parameters), $headers);

        return $this->getKeywordFactory()->createResultCollection($data);
    }

    /**
     * @param string             $query
     * @param KeywordSearchQuery $parameters
     * @param array              $headers
     *
     * @return ResultCollection|Keyword[]
     */
    public function searchMulti($query, KeywordSearchQuery $parameters, array $headers = [])
    {
        $data       = $this->getApi()->searchMulti($query, $this->getParameters($parameters), $headers);
        $collection = new ResultCollection();

        if (null === $data) {
            return $collection;
        }

        if (array_key_exists('page', $data)) {
            $collection->setPage($data['page']);
        }

        if (array_key_exists('total_pages', $data)) {
            $collection->setTotalPages($data['total_pages']);
        }

        if (array_key_exists('total_results', $data)) {
            $collection->setTotalResults($data['total_results']);
        }

        if (array_key_exists('results', $data)) {
            foreach ($data['results'] as $item) {
                if ($item) {
                    $collection->add(null, $this->processSearchMultiItem($item));
                }
            }
        }

        return $collection;
    }

    /**
     * Process multi search items
     *
     * @param  array                                                    $item
     * @return bool|Movie|Person|Person\CastMember|Person\CrewMember|Tv
     * @throws \RuntimeException
     */
    private function processSearchMultiItem(array $item)
    {
        if (array_key_exists('media_type', $item)) {
            switch ($item['media_type']) {
                case 'movie':
                    return $this->getMovieFactory()->create($item);
                case 'tv':
                    return $this->getTvFactory()->create($item);
                case 'person':
                    return $this->getPeopleFactory()->create($item);
                default:
                    throw new \RuntimeException(sprintf(
                        'Could not process media_type "%s" in multi search, type unknown.',
                        $item['media_type']
                    ));
            }
        }

        return false;
    }

    /**
     * Convert parameters back to an array
     *
     * @param  SearchQuery|array $parameters
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
     * Return the related API class
     *
     * @return \Tmdb\Api\Search
     */
    public function getApi()
    {
        return $this->getClient()->getSearchApi();
    }

    /**
     * SearchRepository does not support a generic factory
     *
     * @throws NotImplementedException
     */
    public function getFactory()
    {
        throw new NotImplementedException('SearchRepository does not support a generic factory.');
    }

    /**
     * @param  \Tmdb\Factory\MovieFactory $movieFactory
     * @return $this
     */
    public function setMovieFactory($movieFactory)
    {
        $this->movieFactory = $movieFactory;

        return $this;
    }

    /**
     * @return \Tmdb\Factory\MovieFactory
     */
    public function getMovieFactory()
    {
        return $this->movieFactory;
    }

    /**
     * @param  \Tmdb\Factory\CollectionFactory $collectionFactory
     * @return $this
     */
    public function setCollectionFactory($collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;

        return $this;
    }

    /**
     * @return \Tmdb\Factory\CollectionFactory
     */
    public function getCollectionFactory()
    {
        return $this->collectionFactory;
    }

    /**
     * @param  \Tmdb\Factory\CompanyFactory $companyFactory
     * @return $this
     */
    public function setCompanyFactory($companyFactory)
    {
        $this->companyFactory = $companyFactory;

        return $this;
    }

    /**
     * @return \Tmdb\Factory\CompanyFactory
     */
    public function getCompanyFactory()
    {
        return $this->companyFactory;
    }

    /**
     * @param  \Tmdb\Factory\KeywordFactory $keywordFactory
     * @return $this
     */
    public function setKeywordFactory($keywordFactory)
    {
        $this->keywordFactory = $keywordFactory;

        return $this;
    }

    /**
     * @return \Tmdb\Factory\KeywordFactory
     */
    public function getKeywordFactory()
    {
        return $this->keywordFactory;
    }

    /**
     * @param  \Tmdb\Factory\Movie\ListItemFactory $listItemFactory
     * @return $this
     */
    public function setListItemFactory($listItemFactory)
    {
        $this->listItemFactory = $listItemFactory;

        return $this;
    }

    /**
     * @return \Tmdb\Factory\Movie\ListItemFactory
     */
    public function getListItemFactory()
    {
        return $this->listItemFactory;
    }

    /**
     * @param  \Tmdb\Factory\PeopleFactory $peopleFactory
     * @return $this
     */
    public function setPeopleFactory($peopleFactory)
    {
        $this->peopleFactory = $peopleFactory;

        return $this;
    }

    /**
     * @return \Tmdb\Factory\PeopleFactory
     */
    public function getPeopleFactory()
    {
        return $this->peopleFactory;
    }

    /**
     * @param  \Tmdb\Factory\TvFactory $tvFactory
     * @return $this
     */
    public function setTvFactory($tvFactory)
    {
        $this->tvFactory = $tvFactory;

        return $this;
    }

    /**
     * @return \Tmdb\Factory\TvFactory
     */
    public function getTvFactory()
    {
        return $this->tvFactory;
    }
}
