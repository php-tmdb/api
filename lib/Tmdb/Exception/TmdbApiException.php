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
namespace Tmdb\Exception;
use Tmdb\HttpClient\Request;
use Tmdb\HttpClient\Response;

/**
 * Class TmdbApiException
 * @package Tmdb\Exception
 */
class TmdbApiException extends \Exception
{
    const STATUS_SUCCESS = 1;
    const STATUS_INVALID_SERVICE = 2;
    const STATUS_AUTHENTICATION_FAILED_NO_PERMISSION = 3;
    const STATUS_INVALID_FORMAT = 4;
    const STATUS_INVALID_PARAMETERS = 5;
    const STATUS_INVALID_ID = 6;
    const STATUS_INVALID_API_KEY = 7;
    const STATUS_DUPLICATE_ENTRY = 8;
    const STATUS_SERVICE_OFFLINE = 9;
    const STATUS_SUSPENDED_API_KEY = 10;
    const STATUS_INTERNAL_ERROR = 11;
    const STATUS_UPDATE_SUCCESS = 12;
    const STATUS_DELETE_SUCCESS = 13;
    const STATUS_AUTHENTICATION_FAILED = 14;
    const STATUS_FAILED = 15;
    const STATUS_DEVICE_DENIED = 16;
    const STATUS_SESSION_DENIED = 17;
    const STATUS_VALIDATION_FAILED = 18;
    const STATUS_INVALID_ACCEPT_HEADER = 19;
    const STATUS_INVALID_DATE_RANGE = 20;
    const STATUS_ENTRY_NOT_FOUND = 21;
    const STATUS_INVALID_PAGE = 22;
    const STATUS_INVALID_DATE = 23;
    const STATUS_BACKEND_TIMEOUT = 24;
    const STATUS_REQUEST_COUNT = 25;
    const STATUS_USERNAME_PASSWORD_NOT_PROVIDED = 26;
    const STATUS_TOO_MANY_APPEND_TO_RESPONSE = 27;
    const STATUS_INVALID_TIMEZONE = 28;
    const STATUS_CONFIRM_REQUIRED = 29;
    const STATUS_INVALID_USERNAME_PASSWORD = 30;
    const STATUS_ACCOUNT_DISABLED = 31;
    const STATUS_EMAIL_NOT_VERIFIED = 32;
    const STATUS_INVALID_REQUEST_TOKEN = 33;
    const STATUS_RESOURCE_NOT_FOUND = 34;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * Create the exception
     *
     * @param int             $code
     * @param string          $message
     * @param Request|null    $request
     * @param Response|null   $response
     * @param \Exception|null $previous
     */
    public function __construct($code, $message, $request = null, $response = null, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param  Request $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param  Response $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }
}
