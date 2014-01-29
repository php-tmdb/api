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

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Assert that an array of methods and corresponding classes match
     *
     * @param $subject
     * @param array $instances
     * @throws \Exception
     */
    protected function assertInstancesOf($subject, array $instances = array())
    {
        foreach($instances as $method => $instance) {
            try {
                $this->assertInstanceOf($instance, $subject->$method());
            }
            catch(\Exception $e){
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
}
