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
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Company;

class CompanyFactoryTest extends TestCase
{
    const COMPANY_ID = 1;

    private $data;

    public function setUp()
    {
        $this->data = $this->loadByFile('company/get.json');
    }

    /**
     * @test
     */
    public function shouldConstructCompany()
    {
        /**
         * @var CompanyFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var Company $company
         */
        $company = $factory->create($this->data);

        $this->assertInstanceOf('Tmdb\Model\Company', $company);
        $this->assertInstanceOf('Tmdb\Model\Image\LogoImage', $company->getLogoImage());

        $this->assertEquals(null, $company->getDescription());
        $this->assertEquals('San Francisco, California', $company->getHeadquarters());
        $this->assertEquals('http://www.lucasfilm.com', $company->getHomepage());
        $this->assertEquals(1, $company->getId());
        $this->assertEquals('/8rUnVMVZjlmQsJ45UGotD0Uznxj.png', $company->getLogoPath());
        $this->assertEquals('Lucasfilm', $company->getName());
        $this->assertEquals(null, $company->getParentCompany());
    }

    /**
     * @test
     */
    public function shouldMatchExpectations()
    {
        /**
         * @var CompanyFactory $factory
         */
        $factory = $this->getFactory();

        /**
         * @var Company $company
         */
        $company = $factory->create($this->data);

        $this->assertEquals(null, $company->getDescription());
        $this->assertEquals('San Francisco, California', $company->getHeadquarters());
        $this->assertEquals('http://www.lucasfilm.com', $company->getHomepage());
        $this->assertEquals(1, $company->getId());
        $this->assertEquals('/8rUnVMVZjlmQsJ45UGotD0Uznxj.png', $company->getLogoPath());
        $this->assertEquals('Lucasfilm', $company->getName());
        $this->assertEquals(null, $company->getParentCompany());
    }

    /**
     * @test
     */
    public function callingCollectionReturnsEmptyCollection()
    {
        $factory    = $this->getFactory();
        $collection = $factory->createCollection([]);

        $this->assertEquals(new GenericCollection(), $collection);
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        $factory = $this->getFactory();

        $class = new \stdClass();
        $factory->setImageFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\CompanyFactory';
    }
}
