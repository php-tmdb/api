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
namespace Tmdb\Tests\Helper;

use Tmdb\ApiToken;
use Tmdb\Client;
use Tmdb\Tests\TestCase as Base;

class ImageHelperTest extends Base
{
    /**
     * @var \Tmdb\Helper\ImageHelper
     */
    private $helper;

    public function setUp()
    {
        $client = new Client(new ApiToken('abcdef'));

        $factory = new \Tmdb\Factory\ConfigurationFactory($client->getHttpClient());

        $data          = $this->loadByFile('configuration/get.json');
        $configuration = $factory->create($data);

        $this->helper = new \Tmdb\Helper\ImageHelper($configuration);
    }

    /**
     * @test
     */
    public function shouldContainImageConfiguration()
    {
        $config = $this->helper->getImageConfiguration();

        $this->assertEquals(true, !empty($config));
    }

    /**
     * @test
     */
    public function shouldConstructImageUrl()
    {
        $image = new \Tmdb\Model\Image();

        $image->setFilePath('/test-image.jpg');

        $this->assertEquals(
            '//image.tmdb.org/t/p/original/test-image.jpg',
            $this->helper->getUrl($image)
        );

        $this->assertEquals(
            '//image.tmdb.org/t/p/w45/test-image.jpg',
            $this->helper->getUrl($image, 'w45')
        );
    }

    /**
     * @test
     */
    public function shouldConstructImageElement()
    {
        $image = new \Tmdb\Model\Image();

        $image->setFilePath('/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg');
        $image->setWidth(100);
        $image->setHeight(75);

        $this->assertEquals(
            '<img src="//image.tmdb.org/t/p/w45/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg" width="90" height="70" />',
            $this->helper->getHtml($image, 'w45', 90, 70)
        );
    }

    /**
     * @test
     */
    
    public function shouldReadImageDimensions()
    {
        $image = new \Tmdb\Model\Image();

        $image->setFilePath('/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg');
        $image->setWidth(100);
        $image->setHeight(75);

        $this->assertEquals(
            '<img src="//image.tmdb.org/t/p/w45/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg" width="100" height="75" />',
            $this->helper->getHtml($image, 'w45')
        );
    }

    /**
     * @test
     */
    public function shouldCalculateDimensions()
    {
        $image = new \Tmdb\Model\Image();

        $image->setFilePath('/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg');
        $image->setWidth(100);
        $image->setHeight(75);
        $image->setAspectRatio(1.25);

        $this->assertEquals(
            '<img src="//image.tmdb.org/t/p/w45/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg" width="63" height="50" />',
            $this->helper->getHtml($image, 'w45', null, 50)
        );

        $this->assertEquals(
            '<img src="//image.tmdb.org/t/p/w45/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg" width="63" height="50" />',
            $this->helper->getHtml($image, 'w45', 63)
        );
    }

    /**
     * @test
     */
    public function shouldBeEmptyIfFilePathIsNotGiven()
    {
        $image = new \Tmdb\Model\Image();

        $this->assertEquals('', $this->helper->getHtml($image));
    }

    /**
     * @test
     */
    public function shouldGetImageUrlByString()
    {
        $imageUrl = $this->helper->getUrl('/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg');

        $this->assertEquals('//image.tmdb.org/t/p/original/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg', $imageUrl);
    }

    /**
     * @test
     */
    public function shouldGetImageElementByString()
    {
        $imageUrl = $this->helper->getHtml('/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg');

        $this->assertEquals(
            '<img src="//image.tmdb.org/t/p/original/1NfhdnQAEqcBRCulEhOFSkRrrLv.jpg" width="" height="" />',
            $imageUrl
        );
    }
}
