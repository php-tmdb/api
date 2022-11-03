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

namespace Tmdb\Model\Person;

use Tmdb\Model\Collection\People\PersonInterface;

/**
 * Class CrewMember
 * @package Tmdb\Model\Person
 */
class CrewMember extends AbstractMember implements PersonInterface
{
    public static $properties = [
        'id',
        'credit_id',
        'name',
        'department',
        'job',
        'profile_path'
    ];
    /**
     * @var string
     */
    private $department;
    /**
     * @var string
     */
    private $job;
    /**
     * @var mixed
     */
    private $creditId;

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return self
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param string $job
     * @return self
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreditId()
    {
        return $this->creditId;
    }

    /**
     * @param mixed $creditId
     * @return self
     */
    public function setCreditId($creditId)
    {
        $this->creditId = $creditId;

        return $this;
    }
}
