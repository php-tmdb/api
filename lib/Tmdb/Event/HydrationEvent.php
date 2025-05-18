<?php

declare(strict_types=1);

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 *
 * @version 4.0.0
 */

namespace Tmdb\Event;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Contracts\EventDispatcher\Event;
use Tmdb\Model\AbstractModel;

class HydrationEvent extends Event
{
    private ?\Psr\Http\Message\RequestInterface $lastRequest = null;

    private ?\Psr\Http\Message\ResponseInterface $lastResponse = null;

    /**
     * Constructor.
     */
    public function __construct(private AbstractModel $subject, private array $data = [])
    {
    }

    public function getSubject(): AbstractModel
    {
        return $this->subject;
    }

    public function setSubject(AbstractModel $subject): HydrationEvent
    {
        $this->subject = $subject;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data = []): HydrationEvent
    {
        $this->data = $data;

        return $this;
    }

    public function hasData(): bool
    {
        return !empty($this->data);
    }

    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    public function setLastRequest(?RequestInterface $lastRequest = null): HydrationEvent
    {
        $this->lastRequest = $lastRequest;

        return $this;
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    public function setLastResponse(?ResponseInterface $lastResponse = null): HydrationEvent
    {
        $this->lastResponse = $lastResponse;

        return $this;
    }
}
