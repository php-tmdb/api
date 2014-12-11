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
namespace Tmdb\Event;

use Symfony\Component\EventDispatcher\Event;
use Tmdb\Common\ParameterBag;

class RequestEvent extends Event
{
    /**
     * @var ParameterBag
     */
    private $options;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $type;

    public function __construct(ParameterBag $options)
    {
        $this->options = $options;
    }

    /**
     * @return ParameterBag
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return ParameterBag
     */
    public function setOptions(ParameterBag $options)
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param  string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param  string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
