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

use Tmdb\Factory\TimezoneFactory;
use Tmdb\Model\Timezone\CountryTimezone;

class TimezoneFactoryTest extends TestCase
{
    private $data;

    public function setUp() :void
    {
        $this->data = $this->loadByFile('timezones/get.json');
    }

    /**
     * @test
     */
    public function shouldConstructTimezones()
    {
        /**
         * @var TimezoneFactory $factory
         */
        $factory             = $this->getFactory();
        $timezonesCollection = $factory->createCollection($this->data);

        $this->assertInstanceOf('Tmdb\Model\Collection\Timezones', $timezonesCollection);

        /**
         * @var CountryTimezone $countryTimezone
         */
        foreach ($timezonesCollection as $countryTimezone) {
            $this->assertInstanceOf('Tmdb\Model\Timezone\CountryTimezone', $countryTimezone);
            $this->assertNotEmpty($countryTimezone->getIso31661());

            foreach ($countryTimezone->getTimezones() as $timezone) {
                $this->assertNotEmpty($timezone);
            }
        }
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TimezoneFactory';
    }
}
