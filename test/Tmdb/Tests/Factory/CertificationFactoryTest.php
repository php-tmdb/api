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

use Tmdb\Factory\CertificationFactory;
use Tmdb\Model\Certification;

class CertificationFactoryTest extends TestCase
{
    private $data;

    public function setUp() :void
    {
        $this->data = $this->loadByFile('certification/get.json');
    }

    /**
     * @test
     */
    public function shouldConstructCertification()
    {
        /**
         * @var CertificationFactory $factory
         */
        $factory                 = $this->getFactory();
        $certificationCollection = $factory->createCollection($this->data);

        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $certificationCollection);

        /**
         * @var Certification $certificationCountry
         */
        foreach ($certificationCollection as $certificationCountry) {
            $this->assertInstanceOf('Tmdb\Model\Certification', $certificationCountry);
            $this->assertNotEmpty($certificationCountry->getCountry());

            foreach ($certificationCountry->getCertifications() as $certification) {
                $this->assertInstanceOf('Tmdb\Model\Certification\CountryCertification', $certification);
            }
        }
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\CertificationFactory';
    }
}
