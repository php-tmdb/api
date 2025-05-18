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

namespace Tmdb\Model\Query\Discover;

use DateTime;
use Tmdb\Model\Collection\QueryParametersCollection;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class DiscoverTvQuery.
 */
class DiscoverTvQuery extends QueryParametersCollection
{
    /** Transform args to an AND query */
    public const MODE_AND = 0;

    /** Transform args to an OR query */
    public const MODE_OR = 1;

    /**
     * Minimum value is 1, expected value is an integer.
     *
     * @param int $page
     */
    public function page($page = 1): static
    {
        $this->set('page', (int) $page);

        return $this;
    }

    /**
     * ISO 639-1 code.
     *
     * @param string $language
     */
    public function language($language): static
    {
        $this->set('language', $language);

        return $this;
    }

    /**
     * An ISO 3166-1 code. Combine this filter with with_watch_providers in order to filter your results by a specific watch provider in a specific region.
     *
     * @param string $watchRegion
     */
    public function watchRegion($watchRegion): static
    {
        $this->set('watch_region', $watchRegion);

        return $this;
    }

    /**
     * Only include movies with the specified watch providers. Combine with watch_region.
     *
     * @param array|string $watchProviders
     * @param int          $mode
     */
    public function withWatchProviders($watchProviders, $mode = self::MODE_OR): static
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
     * @param int          $mode
     */
    public function withWatchMonetizationTypes($watchProviders, $mode = self::MODE_OR): static
    {
        $this->set('with_watch_monetization_types', $this->with($watchProviders, $mode));

        return $this;
    }

    /**
     * Available options are vote_average.desc, vote_average.asc, first_air_date.desc,
     * first_air_date.asc, popularity.desc, popularity.asc.
     *
     * @param string $option
     */
    public function sortBy($option): static
    {
        $this->set('sort_by', $option);

        return $this;
    }

    /**
     * Filter the results release dates to matches that include this value.
     * Expected value is a year.
     *
     * @param DateTime|int $year
     */
    public function firstAirDateYear($year): static
    {
        if ($year instanceof DateTime) {
            $year = $year->format('Y');
        }

        $this->set('first_air_date_year', (int) $year);

        return $this;
    }

    /**
     * Only include TV shows that are equal to, or have a vote count higher than this value.
     * Expected value is an integer.
     *
     * @param int $count
     */
    public function voteCountGte($count): static
    {
        $this->set('vote_count.gte', (int) $count);

        return $this;
    }

    /**
     * Only include TV shows that are equal to, or have a higher average rating than this value.
     * Expected value is a float.
     *
     * @param float $average
     */
    public function voteAverageGte($average): static
    {
        $this->set('vote_average.gte', (float) $average);

        return $this;
    }

    /**
     * Format the with compatible parameters.
     *
     * @param array|GenericCollection|string $with
     * @param int                            $mode
     */
    protected function with($with = null, $mode = self::MODE_OR): ?string
    {
        if ($with instanceof GenericCollection) {
            $with = $with->toArray();
        }

        if (\is_array($with)) {
            return $this->andWith($with, $mode);
        }

        return $with;
    }

    /**
     * Creates an and query to combine an AND or an OR expression.
     *
     * @param int $mode
     */
    protected function andWith(array $with, $mode): string
    {
        return
        implode(
            self::MODE_OR === $mode ? '|' : ',',
            array_map([$this, 'normalize'], $with),
        );
    }

    /**
     * Creates an OR query for genres.
     *
     * @return self
     */
    public function withGenresOr(array $genres = [])
    {
        return $this->withGenres(
            implode('|', $genres),
        );
    }

    /**
     * Only include TV shows with the specified genres.
     * Expected value is an integer (the id of a genre).
     *
     * Multiple values can be specified.
     *
     * Comma separated indicates an 'AND' query,
     * while a pipe (|) separated value indicates an 'OR'.
     *
     * @param array|string $genres
     */
    public function withGenres($genres): static
    {
        if (\is_array($genres)) {
            $genres = $this->withGenresAnd($genres);
        }

        $this->set('with_genres', $genres);

        return $this;
    }

    /**
     * Creates an AND query for genres.
     *
     * @return self
     */
    public function withGenresAnd(array $genres = [])
    {
        return $this->withGenres(
            implode(',', $genres),
        );
    }

    /**
     * The minimum release to include. Expected format is YYYY-MM-DD.
     *
     * @param DateTime|string $date
     */
    public function firstAirDateGte($date): static
    {
        if ($date instanceof DateTime) {
            $date = $date->format('Y-m-d');
        }

        $this->set('first_air_date.gte', $date);

        return $this;
    }

    /**
     * The maximum release to include. Expected format is YYYY-MM-DD.
     *
     * @param DateTime|string $date
     */
    public function firstAirDateLte($date): static
    {
        if ($date instanceof DateTime) {
            $date = $date->format('Y-m-d');
        }

        $this->set('first_air_date.lte', $date);

        return $this;
    }

    /**
     * Filter TV shows to include a specific network.
     *
     * Expected value is an integer (the id of a network).
     * They can be comma separated to indicate an 'AND' query.
     *
     * Expected value is an integer (the id of a company).
     * They can be comma separated to indicate an 'AND' query.
     *
     * @param array|string $networks
     */
    public function withNetworks($networks): static
    {
        if (\is_array($networks)) {
            $networks = $this->withNetworksAnd($networks);
        }

        $this->set('with_networks', $networks);

        return $this;
    }

    /**
     * Creates an and query for networks.
     *
     * @return self
     */
    public function withNetworksAnd(array $networks = [])
    {
        return $this->withNetworks(
            implode(',', $networks),
        );
    }

    /**
     * Extract object id's if an collection was passed on.
     */
    protected function normalize($mixed)
    {
        if (\is_object($mixed) && method_exists($mixed, 'getId')) {
            return $mixed->getId();
        }

        return $mixed;
    }
}
