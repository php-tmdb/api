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
namespace Tmdb\Tests\Model\Common\Trailer;

use Tmdb\Model\Common\Trailer\Youtube;
use Tmdb\Tests\Model\TestCase;

class YoutubeTest extends TestCase
{
    /**
     * @var Youtube
     */
    private $subject;

    public function setUp() :void
    {
        $this->subject = $this->hydrate(new Youtube(), [
            'name'   => 'Trailer 1',
            'size'   => 'HD',
            'source' => 'SUXWAEX2jlg',
            'type'   => 'Trailer'
        ]);
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $this->assertEquals('Trailer 1', $this->subject->getName());
        $this->assertEquals('HD', $this->subject->getSize());
        $this->assertEquals('SUXWAEX2jlg', $this->subject->getSource());
        $this->assertEquals('Trailer', $this->subject->getType());
        $this->assertEquals('http://www.youtube.com/watch?v=SUXWAEX2jlg', $this->subject->getUrl());
    }
}
