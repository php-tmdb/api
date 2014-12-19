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

/**
 * Class Account
 * @package Tmdb\Api
 * @see http://docs.themoviedb.apiary.io/#account
 */
class Account extends AbstractApi
{
    /**
     * Get the basic information for an account. You will need to have a valid session id.
     *
     * @param  array $parameters
     * @param  array $headers
     * @return mixed
     */
    public function getAccount(array $parameters = [], array $headers = [])
    {
        return $this->get('account', $parameters, $headers);
    }

    /**
     * Get the lists that you have created and marked as a favorite.
     *
     * @param  integer $accountId
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getLists($accountId, array $parameters = [], array $headers = [])
    {
        return $this->get('account/' . $accountId . '/lists', $parameters, $headers);
    }

    /**
     * Get the list of favorite movies for an account.
     *
     * @param  integer $accountId
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getFavoriteMovies($accountId, array $parameters = [], array $headers = [])
    {
        return $this->get('account/' . $accountId . '/favorite/movies', $parameters, $headers);
    }

    /**
     * Get the list of favorite TV series for an account.
     *
     * @param  integer $accountId
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getFavoriteTvShows($accountId, array $parameters = [], array $headers = [])
    {
        return $this->get('account/' . $accountId . '/favorite/tv', $parameters, $headers);
    }

    /**
     * Add or remove a movie to an accounts favorite list.
     *
     * @param  integer $accountId
     * @param  integer $mediaId
     * @param  boolean $isFavorite
     * @param  string  $mediaType  Either movie or tv
     * @return mixed
     */
    public function favorite($accountId, $mediaId, $isFavorite = true, $mediaType = 'movie')
    {
        return $this->postJson('account/' . $accountId . '/favorite', [
            'media_id'   => $mediaId,
            'media_type' => $mediaType,
            'favorite'   => $isFavorite
        ]);
    }

    /**
     * Get the list of rated movies (and associated rating) for an account.
     *
     * @param  integer $accountId
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getRatedMovies($accountId, array $parameters = [], array $headers = [])
    {
        return $this->get('account/' . $accountId . '/rated/movies', $parameters, $headers);
    }

    /**
     * Get the list of rated TV shows (and associated rating) for an account.
     *
     * @param  integer $accountId
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getRatedTvShows($accountId, array $parameters = [], array $headers = [])
    {
        return $this->get('account/' . $accountId . '/rated/tv', $parameters, $headers);
    }

    /**
     * Get the list of movies on an accounts watchlist.
     *
     * @param  integer $accountId
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getMovieWatchlist($accountId, array $parameters = [], array $headers = [])
    {
        return $this->get('account/' . $accountId . '/watchlist/movies', $parameters, $headers);
    }

    /**
     * Get the list of TV series on an accounts watchlist.
     *
     * @param  integer $accountId
     * @param  array   $parameters
     * @param  array   $headers
     * @return mixed
     */
    public function getTvWatchlist($accountId, array $parameters = [], array $headers = [])
    {
        return $this->get('account/' . $accountId . '/watchlist/tv', $parameters, $headers);
    }

    /**
     * Add or remove a movie to an accounts watch list.
     *
     * @param  integer $accountId
     * @param  integer $mediaId
     * @param  boolean $isOnWatchlist
     * @param  string  $mediaType     Either movie or tv
     * @return mixed
     */
    public function watchlist($accountId, $mediaId, $isOnWatchlist = true, $mediaType = 'movie')
    {
        return $this->postJson('account/' . $accountId . '/watchlist', [
            'media_id'   => $mediaId,
            'media_type' => $mediaType,
            'watchlist'  => $isOnWatchlist
        ]);
    }
}
