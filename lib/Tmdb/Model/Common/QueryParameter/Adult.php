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

namespace Tmdb\Model\Common\QueryParameter;

/**
 * Class Adult.
 */
class Adult implements QueryParameterInterface
{
    public function __construct(private $adult)
    {
    }

    #[\Override]
    public function getKey(): string
    {
        return 'adult';
    }

    /**
     * @return string
     */
    #[\Override]
    public function getValue()
    {
        return $this->adult;
    }
}
