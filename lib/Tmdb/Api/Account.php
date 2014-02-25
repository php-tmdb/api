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
namespace Tmdb\Api;

use Tmdb\Exception\NotImplementedException;

class Account
    extends AbstractApi
{
    /**
     * Get the basic information for an account. You will need to have a valid session id.
     *
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function getAccount(array $parameters = array(), array $headers = array())
    {
        return $this->get('account', $parameters, $headers);
    }

    /**
     * Get the lists that you have created and marked as a favorite.
     *
     * @throws NotImplementedException
     * @return mixed
     */
    public function getLists()
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the list of favorite movies for an account.
     *
     * @throws NotImplementedException
     * @return mixed
     */
    public function getFavoriteMovies()
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Add or remove a movie to an accounts favorite list.
     *
     * @throws NotImplementedException
     * @return mixed
     */
    public function favorite()
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the list of rated movies (and associated rating) for an account.
     *
     * @throws NotImplementedException
     * @return mixed
     */
    public function getRatedMovies()
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the list of movies on an accounts watchlist.
     *
     * @throws NotImplementedException
     * @return mixed
     */
    public function getMovieWatchlist()
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Add or remove a movie to an accounts watch list.
     *
     * @throws NotImplementedException
     * @return mixed
     */
    public function watchlist()
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }
}
