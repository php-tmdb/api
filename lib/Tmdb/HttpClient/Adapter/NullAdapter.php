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
namespace Tmdb\HttpClient\Adapter;

use Tmdb\Common\ParameterBag;

class NullAdapter extends AbstractAdapter implements AdapterInterface
{
    /**
     * {@inheritDoc}
     */
    public function get($path, ParameterBag $parameterBag)
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, $body = null, ParameterBag $parameterBag)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function put($path, $body = null, ParameterBag $parameterBag)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function patch($path, $body = null, ParameterBag $parameterBag)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function delete($path, $body = null, ParameterBag $parameterBag)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function head($path, ParameterBag $parameterBag)
    {
        return null;
    }
}
