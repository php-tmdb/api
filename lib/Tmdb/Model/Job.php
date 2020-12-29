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
 * @version 4.0.0
 */

namespace Tmdb\Model;

/**
 * Class Job
 * @package Tmdb\Model
 */
class Job extends AbstractModel
{
    public static $properties = [
        'department',
        'job_list'
    ];

    /**
     * @var string
     */
    private $department;

    /**
     * @var array
     */
    private $jobList;

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param string $department
     *
     * @return void
     */
    public function setDepartment($department): void
    {
        $this->department = $department;
    }

    /**
     * @return array
     */
    public function getJobList()
    {
        return $this->jobList;
    }

    /**
     * @param array $jobList
     *
     * @return void
     */
    public function setJobList(array $jobList): void
    {
        $this->jobList = $jobList;
    }
}
