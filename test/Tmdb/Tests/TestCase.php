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
namespace Tmdb\Tests;

use GuzzleHttp\Message\Response;
use Tmdb\ApiToken;
use Tmdb\Client;
use Tmdb\Common\ObjectHydrator;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Assert that an array of methods and corresponding classes match
     *
     * @param $subject
     * @param  array      $instances
     * @throws \Exception
     */
    protected function assertInstancesOf($subject, array $instances = [])
    {
        foreach ($instances as $method => $instance) {
            try {
                $this->assertInstanceOf($instance, $subject->$method());
            } catch (\Exception $e) {
                throw new \Exception(sprintf(
                    'Failed asserting that calling "%s" returns an instance of expected "%s".',
                    sprintf('%s::%s', get_class($subject), $method),
                    $instance
                ));
            }
        }
    }

    /**
     * Load an json file from the Resources directory
     *
     * @param $file
     * @return mixed
     */
    protected function loadByFile($file)
    {
        return json_decode(
            file_get_contents(
                sprintf(
                    '%s/%s',
                    'test/Tmdb/Tests/Resources/',
                    $file
                )
            ),
            true
        );
    }

    /**
     * Get a TMDB Client with an mocked HTTP dependency
     *
     * @return \Tmdb\Client
     */
    protected function getClientWithMockedHttpClient()
    {
        $token      = new ApiToken('abcdef');

        $adapter = $this->getMockedHttpClient();
        $adapter
            ->expects($this->any())
            ->method('send');

        $mock = $this->getMock(
            'Tmdb\HttpClient\Adapter\AdapterInterface'
        );

//        $mock = $this->getMock(
//            'Tmdb\HttpClient\Adapter\AdapterInterface',
//            [],
//            [[], $httpClient]
//        );

        $client = new \Tmdb\Client($token, $mock);
//        $client->setHttpClient($mock);
        return $client;
    }

    /**
     * Get TMDB Client
     *
     * @return Client
     */
    protected function getMockedTmdbClient()
    {
        $token    = new ApiToken('abcdef');
        $response = new FakeResponse('200');

        $adapter = $this->getMockBuilder('Tmdb\HttpClient\Adapter\NullAdapter')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $adapter
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue([]))
        ;

        $adapter
            ->expects($this->any())
            ->method('post')
            ->will($this->returnValue([]))
        ;

        return new Client($token, $adapter);
    }

    /**
     * Get mocked http client
     *
     * @param  array                                    $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockedHttpClient(array $methods = [])
    {
        return $this->getMock('Guzzle\Http\Client', array_merge(
            $methods,
            ['send']
        ));
    }

    /**
     * Hydrate object
     *
     * @param $object
     * @param $data
     * @return \Tmdb\Model\AbstractModel
     */
    protected function hydrate($object, $data)
    {
        $objectHydrator = new ObjectHydrator();

        return $objectHydrator->hydrate($object, $data);
    }
}

class FakeResponse
{
    private $statusCode;

    public function __construct($statusCode = 200)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param  int   $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function __toString()
    {
        return '';
    }
}
