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

namespace Tmdb\Model\Collection;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class ResultCollection.
 *
 * @template T of AbstractModel
 *
 * @extends GenericCollection<T>
 */
class ResultCollection extends GenericCollection
{
    /**
     * @var array
     */
    public static $properties = [
        'page',
        'total_pages',
        'total_results',
    ];
    private int $page = 1;
    private int $totalPages = 1;
    private int $totalResults = 0;

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     *
     * @return $this
     */
    public function setPage($page): static
    {
        $this->page = (int) $page;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     *
     * @return $this
     */
    public function setTotalPages($totalPages): static
    {
        $this->totalPages = (int) $totalPages;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalResults()
    {
        return $this->totalResults;
    }

    /**
     * @param int $totalResults
     *
     * @return $this
     */
    public function setTotalResults($totalResults): static
    {
        $this->totalResults = (int) $totalResults;

        return $this;
    }
}
