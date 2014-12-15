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
namespace Tmdb\HttpClient;
use Tmdb\Common\ParameterBag;

/**
 * Class Response
 * @package Tmdb\HttpClient
 */
class Response
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $code;

    /**
     * @var ParameterBag
     */
    private $headers;

    /**
     * Construct an response object
     *
     * @param int          $code
     * @param null         $content
     * @param ParameterBag $headers
     */
    public function __construct(
        $code = 200,
        $content = null,
        ParameterBag $headers = null
    ) {
        $this->code    = $code;
        $this->content = $content;
        $this->headers = $headers;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param  int   $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param  string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param  ParameterBag $headers
     * @return $this
     */
    public function setHeaders(ParameterBag $headers)
    {
        $this->headers = $headers;

        return $this;
    }
}
