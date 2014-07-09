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
namespace Tmdb\Tests\Model\Query;

use Tmdb\Model\Query\ChangesQuery;
use Tmdb\Tests\TestCase;

class ChangesQueryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateValidQuery()
    {
        $query = new ChangesQuery();

        $now      = new \DateTime();
        $tomorrow = new \DateTime('tomorrow');

        $query
            ->from($now)
            ->to($tomorrow)
            ->page(1)
        ;

        $this->assertEquals($now->format('Y-m-d'), $query->get('start_date'));
        $this->assertEquals($tomorrow->format('Y-m-d'), $query->get('end_date'));
        $this->assertEquals(1, $query->get('page'));
    }
}
