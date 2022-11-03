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

namespace Tmdb\Model\Collection;

use Tmdb\Model\Common\GenericCollection;

/**
 * Class ResultCollection
 * @package Tmdb\Model\Collection
 */
class ResultCollection extends GenericCollection
{
    /**
     * @var array
     */
    public static $properties = [
        'page',
        'total_pages',
        'total_results'
    ];
    /**
     * @var int
     */
    private $page = 1;
    /**
     * @var int
     */
    private $totalPages = 1;
    /**
     * @var int
     */
    private $totalResults = 0;

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return self
     */
    public function setPage($page)
    {
        $this->page = (int)$page;

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
     * @return self
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = (int)$totalPages;

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
     * @return self
     */
    public function setTotalResults($totalResults)
    {
        $this->totalResults = (int)$totalResults;

        return $this;
    }
}
