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

use Tmdb\Factory\CompanyFactory;
use Tmdb\Model\Collection\Changes;

class ChangesFactoryTest extends TestCase
{
    private $data;

    /**
     * @var Changes
     */
    private $changes;

    public function setUp()
    {
        $this->data = $this->loadByFile('changes/movies.json');

        /**
         * @var CompanyFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var Changes $changes
         */
        $this->changes = $factory->createCollection($this->data);
    }

    /**
     * @test
     */
    public function shouldCreateCollection()
    {
        $this->assertEquals(true, !empty($this->changes));

        $this->assertEquals(1, $this->changes->getPage());
        $this->assertEquals(12, $this->changes->getTotalPages());
        $this->assertEquals(1151, $this->changes->getTotalResults());

        $this->assertEquals(100, count($this->changes));
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\ChangesFactory';
    }
}
