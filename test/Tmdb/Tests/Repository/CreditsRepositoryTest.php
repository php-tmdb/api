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
namespace Tmdb\Tests\Repository;

class CreditsRepositoryTest extends TestCase
{
    const CREDITS_ID = '5240760b5dbf5b0c2c0139db';

    /**
     * @test
     */
    public function shouldLoadCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $this->getAdapter()->expects($this->once())
            ->method('get')
            ->with($this->getRequest('credit/' . self::CREDITS_ID, []))
        ;

        $repository->load(self::CREDITS_ID);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\Credits';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\CreditsRepository';
    }
}
