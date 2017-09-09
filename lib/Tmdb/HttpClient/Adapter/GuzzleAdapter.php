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

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\RetryMiddleware;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Tmdb\Common\ParameterBag;
use Tmdb\Exception\NullResponseException;
use Tmdb\HttpClient\Request;
use Tmdb\HttpClient\Response;

class GuzzleAdapter extends AbstractAdapter
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(ClientInterface $client = null, array $options = [])
    {
        if (null === $client) {
            $client = new Client($options);
        }

        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function registerSubscribers(EventDispatcherInterface $eventDispatcher)
    {
        /** @var HandlerStack $handler */
        $handler = $this->client->getConfig('handler');

        $handler->push(Middleware::retry(function(
            $retries,
            \GuzzleHttp\Psr7\Request $request,
            \GuzzleHttp\Psr7\Response $response = null,
            RequestException $exception = null
        ){
            if ($retries >= 5) {
                return false;
            }

            // Retry connection exception
            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                if($response->getStatusCode() >= 500) {
                    return true;
                }

                if($response->getStatusCode() === 429) {
                    $sleep = (int) $response->getHeaderLine('retry-after');

                    /**
                     * @see https://github.com/php-tmdb/api/issues/154
                     * Maybe it's even better to set it to $retries value
                     */
                    if (0 === $sleep) $sleep = 1;

                    // TMDB allows 40 requests per 10 seconds, anything higher should be faulty.
                    if ($sleep > 10) {
                        return false;
                    }

                    sleep($sleep);

                    return true;
                }
            }

            return false;
        }));
    }

    /**
     * Format the request for Guzzle
     *
     * @param  Request $request
     * @return array
     */
    public function getConfiguration(Request $request)
    {
        $this->request = $request;

        return [
            'base_uri' => $request->getOptions()->get('base_url'),
            'headers'  => $request->getHeaders()->all(),
            'query'    => $request->getParameters()->all()
        ];
    }

    /**
     * Create the response object
     *
     * @param  ResponseInterface         $adapterResponse
     * @return \Tmdb\HttpClient\Response
     */
    private function createResponse(ResponseInterface $adapterResponse = null)
    {
        $response = new Response();

        if ($adapterResponse !== null) {
            $response->setCode($adapterResponse->getStatusCode());
            $response->setHeaders(new ParameterBag($adapterResponse->getHeaders()));
            $response->setBody((string) $adapterResponse->getBody());
        }

        return $response;
    }

    /**
     * Create the request exception
     *
     * @param  Request                          $request
     * @param  RequestException|null            $previousException
     * @throws \Tmdb\Exception\TmdbApiException
     */
    protected function handleRequestException(Request $request, RequestException $previousException)
    {
        if (null !== $previousException) {
            $response = $previousException->getResponse();

            if (null == $response || ($response->getStatusCode() >= 500 && $response->getStatusCode() <= 599)) {
                throw new NullResponseException($this->request, $previousException);
            }
        }

        throw $this->createApiException(
            $request,
            $this->createResponse($previousException->getResponse()),
            $previousException
        );
    }

    /**
     * {@inheritDoc}
     */
    public function get(Request $request)
    {
        $response = null;
        try {
            $response = $this->client->request(
                'GET',
                $request->getPath(),
                $this->getConfiguration($request)
            );
        } catch (RequestException $e) {
            $this->handleRequestException($request, $e);
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function post(Request $request)
    {
        $response = null;

        try {
            $response = $this->client->request(
                'POST',
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            $this->handleRequestException($request, $e);
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function put(Request $request)
    {
        $response = null;

        try {
            $response = $this->client->request(
                'PUT',
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            $this->handleRequestException($request, $e);
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function patch(Request $request)
    {
        $response = null;

        try {
            $response = $this->client->request(
                'PATCH',
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            $this->handleRequestException($request, $e);
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Request $request)
    {
        $response = null;

        try {
            $response = $this->client->request(
                'DELETE',
                $request->getPath(),
                array_merge(
                    ['body' => $request->getBody()],
                    $this->getConfiguration($request)
                )
            );
        } catch (RequestException $e) {
            $this->handleRequestException($request, $e);
        }

        return $this->createResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function head(Request $request)
    {
        $response = null;

        try {
            $response = $this->client->request(
                'HEAD',
                $request->getPath(),
                $this->getConfiguration($request)
            );
        } catch (RequestException $e) {
            $this->handleRequestException($request, $e);
        }

        return $this->createResponse($response);
    }

    /**
     * Retrieve the Guzzle Client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param  ClientInterface $client
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }
}
