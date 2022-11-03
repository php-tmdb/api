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

namespace Tmdb\Model\Query\Discover;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\QueryParametersCollection;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class DiscoverMoviesQuery
 * @package Tmdb\Model\Query\Discover
 */
class DiscoverMoviesQuery extends QueryParametersCollection
{
    /** Transform args to an AND query */
    public const MODE_AND = 0;

    /** Transform args to an OR query */
    public const MODE_OR = 1;

    /**
     * Only include movies with certifications for a specific country.
     *
     * When this value is specified, 'certification.lte' is required.
     * A ISO 3166-1 is expected.
     *
     * @param string $country
     * @return self
     */
    public function certificationCountry($country)
    {
        $this->set('certification_country', $country);

        return $this;
    }

    /**
     * Only include movies with this certification.
     *
     * Expected value is a valid certification for the specified 'certification_country'.
     *
     * @param mixed $value
     * @return self
     */
    public function certification($value)
    {
        $this->set('certification', $value);

        return $this;
    }

    /**
     * Only include movies with this certification and lower.
     *
     * Expected value is a valid certification for the specified 'certification_country'.
     *
     * @param mixed $value
     * @return self
     */
    public function certificationLte($value)
    {
        $this->set('certification.lte', $value);

        return $this;
    }

    /**
     * Toggle the inclusion of adult titles.
     *
     * Expected value is a boolean, true or false. Default is false.
     *
     * @param boolean $allow
     * @return self
     */
    public function includeAdult($allow = true)
    {
        $this->set('include_adult', (bool)$allow);

        return $this;
    }

    /**
     * Toggle the inclusion of items marked as a video.
     *
     * Expected value is a boolean, true or false. Default is true.
     *
     * @param boolean $allow
     * @return self
     */
    public function includeVideo($allow = true)
    {
        $this->set('include_video', (bool)$allow);

        return $this;
    }

    /**
     * ISO 639-1 code.
     *
     * @param string $language
     * @return self
     */
    public function language($language)
    {
        $this->set('language', $language);

        return $this;
    }

    /**
     * An ISO 3166-1 code. Combine this filter with with_watch_providers in order to filter your results by a specific watch provider in a specific region.
     *
     * @param string $watchRegion
     * @return self
     */
    public function watchRegion($watchRegion)
    {
        $this->set('watch_region', $watchRegion);

        return $this;
    }

    /**
     * Only include movies with the specified watch providers. Combine with watch_region.
     *
     * @param array|string $watchProviders
     * @param int $mode
     * @return self
     */
    public function withWatchProviders($watchProviders, $mode = self::MODE_OR)
    {
        $this->set('with_watch_providers', $this->with($watchProviders, $mode));

        return $this;
    }

    /**
     * Only include movies with the specified monetization types. Combine with watch_region.
     *
     * Allowed Values: flatrate, free, ads, rent, buy
     *
     * @param array|string $watchProviders
     * @param int $mode
     * @return self
     */
    public function withWatchMonetizationTypes($watchProviders, $mode = self::MODE_OR)
    {
        $this->set('with_watch_monetization_types', $this->with($watchProviders, $mode));

        return $this;
    }

    /**
     * Minimum value is 1, expected value is an integer.
     *
     * @param integer $page
     * @return self
     */
    public function page($page = 1)
    {
        $this->set('page', (int)$page);

        return $this;
    }

    /**
     * Filter the results so that only the primary release date year has this value.
     * Expected value is a year.
     *
     * @param DateTime|integer $year
     * @return self
     */
    public function primaryReleaseYear($year)
    {
        $this->set('primary_release_year', (int)$this->getDate($year, 'Y'));

        return $this;
    }

    /**
     * @param DateTime|string|integer $year
     * @param string $format
     *
     * @return false|string
     */
    protected function getDate($year, $format = 'Y-m-d')
    {
        return ($year instanceof DateTime) ? $year->format($format) : (string)$year;
    }

    /**
     * @return static
     * @deprecated
     *
     */
    public function primaryReleaseYearGte($year): self
    {
        return $this->primaryReleaseDateGte($year);
    }

    /**
     * Filter by the primary release date and only include those which are greater than or equal to the specified value.
     *
     * Expected format is YYYY-MM-DD.
     *
     * @param DateTime|integer $year
     * @return self
     */
    public function primaryReleaseDateGte($year)
    {
        $this->set('primary_release_date.gte', $this->getDate($year));

        return $this;
    }

    /**
     * @return static
     * @deprecated
     *
     */
    public function primaryReleaseYearLte($year): self
    {
        return $this->primaryReleaseDateLte($year);
    }

    /**
     * Filter by the primary release date and only include those which are less than or equal to the specified value.
     *
     * Expected format is YYYY-MM-DD.
     *
     * @param DateTime|integer $year
     * @return self
     */
    public function primaryReleaseDateLte($year)
    {
        $this->set('primary_release_date.lte', $this->getDate($year));

        return $this;
    }

    /**
     * Filter by all available release dates and only include those which are greater or equal to the specified value.
     *
     * Expected format is YYYY-MM-DD.
     *
     * @param DateTime|string $date
     * @return self
     */
    public function releaseDateGte($date)
    {
        $this->set('release_date.gte', $this->getDate($date));

        return $this;
    }

    /**
     * Filter by all available release dates and only include those which are less or equal to the specified value.
     *
     * Expected format is YYYY-MM-DD.
     *
     * @param DateTime $date
     * @return self
     */
    public function releaseDateLte($date)
    {
        $this->set('release_date.lte', $this->getDate($date));

        return $this;
    }

    /**
     * Available options are
     *
     * - popularity.asc
     * - popularity.desc
     * - release_date.asc
     * - release_date.desc
     * - revenue.asc
     * - revenue.desc
     * - primary_release_date.asc
     * - primary_release_date.desc
     * - original_title.asc
     * - original_title.desc
     * - vote_average.asc
     * - vote_average.desc
     * - vote_count.asc
     * - vote_count.desc
     *
     * @param string $option
     * @return self
     */
    public function sortBy($option)
    {
        $this->set('sort_by', $option);

        return $this;
    }

    /**
     * Filter movies by their vote count and only include movies that have a
     * vote count that is equal to or lower than the specified value.
     *
     * @param integer $count
     * @return self
     */
    public function voteCountGte($count)
    {
        $this->set('vote_count.gte', (int)$count);

        return $this;
    }

    /**
     * Filter movies by their vote count and only include movies that have a
     * vote count that is equal to or lower than the specified value.
     *
     * Expected value is an integer.
     *
     * @param integer $count
     * @return self
     */
    public function voteCountLte($count)
    {
        $this->set('vote_count.lte', (int)$count);

        return $this;
    }

    /**
     * Filter movies by their vote average and only include those that have an
     * average rating that is equal to or higher than the specified value.
     *
     * Expected value is a float.
     *
     * @param float $average
     * @return self
     */
    public function voteAverageGte($average)
    {
        $this->set('vote_average.gte', (float)$average);

        return $this;
    }

    /**
     * Filter movies by their vote average and only include those that have an
     * average rating that is equal to or lower than the specified value.
     *
     * Expected value is a float.
     *
     * @param float $average
     * @return self
     */
    public function voteAverageLte($average)
    {
        $this->set('vote_average.lte', (float)$average);

        return $this;
    }

    /**
     * Only include movies that have this person id added as a cast member.
     *
     * Expected value is an integer (the id of a person).
     * Comma separated indicates an 'AND' query, while a pipe (|) separated value indicates an 'OR'.
     *
     * @param array|string $cast
     * @param int $mode
     * @return self
     */
    public function withCast($cast, $mode = self::MODE_OR)
    {
        $this->set('with_cast', $this->with($cast, $mode));

        return $this;
    }

    /**
     * Format the with compatible parameters.
     *
     * @param array|string $with
     * @param int $mode
     *
     * @return null|string
     */
    protected function with($with = null, $mode = self::MODE_OR): ?string
    {
        if ($with instanceof GenericCollection) {
            $with = $with->toArray();
        }

        if (is_array($with)) {
            return $this->andWith((array)$with, $mode);
        }

        return $with;
    }

    /**
     * Creates an and query to combine an AND or an OR expression.
     *
     * @param array $with
     * @param int $mode
     * @return string
     */
    protected function andWith(array $with, $mode)
    {
        return (
        implode(
            $mode === self::MODE_OR ? '|' : ',',
            array_map([$this, 'normalize'], $with)
        )
        );
    }

    /**
     * Only include movies that have this person id added as a crew member.
     *
     * Expected value is an integer (the id of a person).
     * Comma separated indicates an 'AND' query, while a pipe (|) separated value indicates an 'OR'.
     *
     * @param array|string $crew
     * @param int $mode
     * @return self
     */
    public function withCrew($crew, $mode = self::MODE_OR)
    {
        $this->set('with_crew', $this->with($crew, $mode));

        return $this;
    }

    /**
     * Filter movies to include a specific company.
     *
     * Expected value is an integer (the id of a company).
     * Comma separated indicates an 'AND' query, while a pipe (|) separated value indicates an 'OR'.
     *
     * @param array|string $companies
     * @param int $mode
     * @return self
     */
    public function withCompanies($companies, $mode = self::MODE_OR)
    {
        $this->set('with_companies', $this->with($companies, $mode));

        return $this;
    }

    /**
     * Only include movies with the specified genres.
     * Expected value is an integer (the id of a genre).
     *
     * Multiple values can be specified.
     *
     * Comma separated indicates an 'AND' query, while a pipe (|) separated value indicates an 'OR'.
     *
     * If an array is supplied this defaults to an AND query
     *
     * @param array|string $genres
     * @param int $mode
     * @return self
     */
    public function withGenres($genres, $mode = self::MODE_OR)
    {
        $this->set('with_genres', $this->with($genres, $mode));

        return $this;
    }

    /**
     * Only include movies with the specified keywords.
     * Expected value is an integer (the id of a keyword).
     *
     * Multiple values can be specified.
     *
     * Comma separated indicates an 'AND' query, while a pipe (|) separated value indicates an 'OR'.
     *
     * If an array is supplied this defaults to an AND query
     *
     * @param array|string $keywords
     * @param int $mode
     * @return self
     */
    public function withKeywords($keywords, $mode = self::MODE_OR)
    {
        $this->set('with_keywords', $this->with($keywords, $mode));

        return $this;
    }

    /**
     * Only include movies that have these person id's added as a cast or crew member.
     *
     * Expected value is an integer (the id or ids of a person).
     * Comma separated indicates an 'AND' query, while a pipe (|) separated value indicates an 'OR'.
     *
     * @param array|string $people
     * @param int $mode
     * @return self
     */
    public function withPeople($people, $mode = self::MODE_OR)
    {
        $this->set('with_people', $this->with($people, $mode));

        return $this;
    }

    /**
     * Filter the results release dates to matches that include this value.
     * Expected value is a year.
     *
     * @param DateTime|integer $year
     * @return self
     */
    public function year($year)
    {
        $this->set('year', (int)$this->getDate($year, 'Y'));

        return $this;
    }

    /**
     * Extract object id's if an collection was passed on.
     *
     * @param $mixed
     * @return mixed
     */
    protected function normalize($mixed)
    {
        if (is_object($mixed) && method_exists($mixed, 'getId')) {
            return $mixed->getId();
        }

        return $mixed;
    }
}
