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
namespace Tmdb\Tests\HttpClient\Plugin;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\TmdbEvents;
use Tmdb\HttpClient\Plugin\AcceptJsonHeaderPlugin;
use Tmdb\HttpClient\Request;
use Tmdb\Tests\TestCase;

class AcceptJsonHeaderPluginTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAddToken()
    {
        $request = new Request('/', 'GET');
        $event   = new RequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addSubscriber(new AcceptJsonHeaderPlugin());
        $eventDispatcher->dispatch(TmdbEvents::BEFORE_REQUEST, $event);

        $this->assertEquals('application/json', (string) $event->getRequest()->getHeaders()->get('Accept'));
    }
}
