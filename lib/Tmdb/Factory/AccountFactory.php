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
namespace Tmdb\Factory;

use Tmdb\Exception\NotImplementedException;
use Tmdb\Model\Account;
use Tmdb\Model\Lists\Result;

class AccountFactory extends AbstractFactory
{
    /**
     * @var MovieFactory
     */
    private $movieFactory;

    public function __construct()
    {
        $this->movieFactory = new MovieFactory();
    }

    /**
     * @param array $data
     *
     * @return Account
     */
    public function create(array $data = array())
    {
        return $this->hydrate(new Account(), $data);
    }

    /**
     * @param array $data
     *
     * @return Result
     */
    public function createStatusResult(array $data = array())
    {
        return $this->hydrate(new Result(), $data);
    }

    /**
     * Create movie
     *
     * @param array $data
     * @return \Tmdb\Model\Movie
     */
    public function createMovie(array $data = array()) {
        return $this->getMovieFactory()->create($data);
    }

    /**
     * Create list item
     *
     * @param array $data
     * @return \Tmdb\Model\AbstractModel
     */
    public function createListItem(array $data = array())
    {
        return $this->hydrate(new Account\ListItem(), $data);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = array())
    {
        throw new NotImplementedException('Not implemented');
    }

    /**
     * @param \Tmdb\Factory\MovieFactory $movieFactory
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
}
