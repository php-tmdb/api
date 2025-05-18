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

namespace Tmdb\Model\Search;

use Tmdb\Model\Collection\QueryParametersCollection;

/**
 * Class SearchQuery.
 */
class SearchQuery extends QueryParametersCollection
{
    /**
     * Constructor.
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->page(1);
    }

    /**
     * Minimum 1, maximum 1000.
     *
     * @param int $page
     */
    public function page($page): static
    {
        $this->set('page', $page);

        return $this;
    }

    /**
     * CGI escaped string.
     *
     * @param string $query
     */
    public function query($query): static
    {
        $this->set('query', $query);

        return $this;
    }
}
