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
namespace Tmdb\Tests\Factory;

use Tmdb\Model\Collection\Jobs;

class JobsFactoryTest extends TestCase
{
    private $jobs;

    public function setUp()
    {
        $factory = $this->getFactory();
        $data    = $this->loadByFile('jobs/list.json');

        $this->jobs = $factory->createCollection($data);
    }

    /**
     * @test
     */
    public function shouldConstructJobs()
    {
        $this->assertInstanceOf('Tmdb\Model\Collection\Jobs', $this->jobs);
    }

    /**
     * @test
     */
    public function shouldFilterDepartment()
    {
        $filteredJobs = $this->jobs->filterByDepartment('Actors');

        $expectedJobs = [
            'Actor',
            'Stunt Double',
            'Voice',
            'Cameo',
            'Special Guest'
        ];

        foreach ($filteredJobs->getJobList() as $filteredJob) {
            $this->assertEquals(true, in_array($filteredJob, $expectedJobs));
        }
    }

    /**
     * @test
     */
    public function shouldReturnEmptyDepartmentCollection()
    {
        $filteredJobs = $this->jobs->filterByDepartment('JOB_DOES_NOT_EXIST')->getAll();

        $this->assertEquals(true, empty($filteredJobs));
    }

    /**
     * @test
     */
    public function shouldFilterJobsByDepartment()
    {
        $filteredJobs = $this->jobs->filterByDepartmentAndReturnJobsList('Actors');

        $expectedJobs = [
            'Actor',
            'Stunt Double',
            'Voice',
            'Cameo',
            'Special Guest'
        ];

        foreach ($filteredJobs as $filteredJob) {
            $this->assertEquals(true, in_array($filteredJob, $expectedJobs));
        }
    }

    /**
     * @test
     */
    public function shouldReturnEmptyJobsByDepartmentCollection()
    {
        $filteredJobs = $this->jobs->filterByDepartmentAndReturnJobsList('JOB_DOES_NOT_EXIST')->getAll();

        $this->assertEquals(true, empty($filteredJobs));
    }

    /**
     * @test
     */
    public function shouldFilterByJob()
    {
        $filteredJobs = $this->jobs->filterByJob('Stunt Double');

        $this->assertEquals('Actors', $filteredJobs->getDepartment());
    }

    /**
     * @test
     */
    public function shouldReturnEmptyJobsCollection()
    {
        $filteredJobs = $this->jobs->filterByJob('JOB_DOES_NOT_EXIST')->getAll();

        $this->assertEquals(true, empty($filteredJobs));
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\JobsFactory';
    }
}
