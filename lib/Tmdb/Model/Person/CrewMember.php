<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Model\Person;

use Tmdb\Model\Collection\People\PersonInterface;

/**
 * Class CrewMember.
 */
class CrewMember extends AbstractMember implements PersonInterface
{
    public static $properties = [
        'id',
        'credit_id',
        'name',
        'department',
        'job',
        'profile_path',
    ];
    /**
     * @var string
     */
    private $department;
    /**
     * @var string
     */
    private $job;
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
     */
    public function setDepartment($department): static
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
     */
    public function setJob($job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getCreditId()
    {
        return $this->creditId;
    }

    public function setCreditId($creditId): static
    {
        $this->creditId = $creditId;

        return $this;
    }
}
