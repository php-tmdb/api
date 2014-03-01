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
namespace Tmdb\Tests\Model;

use Tmdb\Model\Change;

class ChangeTest extends TestCase
{
    /**
     * @test
     */
    public function isFunctional()
    {
        $change = new Change();

        $change->setId(1);
        $change->setAdult(false);

        $this->assertEquals(1, $change->getId());
        $this->assertEquals(false, $change->getAdult());
    }
}
