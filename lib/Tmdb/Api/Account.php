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
     * @param array $options
     * @param array $headers
     * @throws NotImplementedException
     * @return mixed
     */
    public function getAccount(array $options = array(), array $headers = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the lists that you have created and marked as a favorite.
     *
     * @param $account_id
     * @param $options array
     * @param array $headers
     * @throws NotImplementedException
     * @return mixed
     */
    public function getLists($account_id, array $options = array(), array $headers = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the list of favorite movies for an account.
     *
     * @param $account_id
     * @param array $options
     * @param array $headers
     * @throws NotImplementedException
     * @return mixed
     */
    public function getFavoriteMovies($account_id, array $options = array(), array $headers = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Add or remove a movie to an accounts favorite list.
     *
     * @param $account_id
     * @param array $options
     * @param array $headers
     * @throws NotImplementedException
     * @return mixed
     */
    public function favorite($account_id, array $options = array(), array $headers = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the list of rated movies (and associated rating) for an account.
     *
     * @param $account_id
     * @param array $options
     * @param array $headers
     * @throws NotImplementedException
     * @return mixed
     */
    public function getRatedMovies($account_id, array $options = array(), array $headers = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Get the list of movies on an accounts watchlist.
     *
     * @param $account_id
     * @param array $options
     * @param array $headers
     * @throws NotImplementedException
     * @return mixed
     */
    public function getMovieWatchlist($account_id, array $options = array(), array $headers = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }

    /**
     * Add or remove a movie to an accounts watch list.
     *
     * @param $account_id
     * @param array $options
     * @param array $headers
     * @throws NotImplementedException
     * @return mixed
     */
    public function watchlist($account_id, array $options = array(), array $headers = array())
    {
        throw new NotImplementedException(__METHOD__ . ' has not been implemented yet.');
    }
}