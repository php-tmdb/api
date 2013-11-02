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
namespace Tmdb\Model;

use Tmdb\Client;
use Tmdb\Model\Common\Collection;

abstract class Changes extends AbstractModel {

    private $from = null;
    private $to   = null;
    private $page = null;

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * Set the from parameter
     *
     * @param \DateTime $date
     * @return $this
     */
    public function from($date)
    {
        $this->from = $date->format('Y-m-d');

        return $this;
    }

    /**
     * Set the to parameter
     *
     * @param \DateTime $date
     * @return $this
     */
    public function to($date)
    {
        $this->to = $date->format('Y-m-d');

        return $this;
    }

    /**
     * Set the page parameter
     *
     * @param int $page
     * @return $this
     */
    public function page($page = 1) {
        $this->page = (int) $page;

        return $this;
    }

    public function execute()
    {
        $collection = new Collection();

        $response = $this->getClient()->api('changes')->getMovieChanges();

        if (!empty($response)) {
            foreach($response['results'] as $change) {
                $collection->add($change);
            }
        }

        return $collection;
    }

    abstract public function getEntity();
}