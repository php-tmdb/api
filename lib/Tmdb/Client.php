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
namespace Tmdb;

/**
 * Client wrapper for TMDB
 * @package Tmdb
 */
class Client extends Engine
{
    use ApiMethodsTrait;

    /** Client Version */
    const VERSION  = '2.0.2';

    /** Base API URI */
    const TMDB_URI = 'api.themoviedb.org/3/';

    public function __construct(ApiToken $token, $options = [])
    {
        if(!array_key_exists('host', $options))
        {
            $options['host'] = self::TMDB_URI;
        }
        parent::__construct($token, $options);
    }
}
