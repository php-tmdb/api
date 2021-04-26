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

namespace Tmdb\Tests\Helper;

use Nyholm\Psr7\Request;
use Tmdb\Helper\RequestQueryHelper;
use Tmdb\Tests\TestCase as Base;

class RequestQueryHelperTest extends Base
{
    /**
     * @test
     */
    public function testIssue236()
    {
        $helper = new RequestQueryHelper();
        $request = new Request('GET', 'http://localhost');
        $request = $helper->withQuery($request, 'air_date.gte', 1);

        $this->assertEquals('http://localhost?air_date.gte=1', (string)$request->getUri());
    }
}
