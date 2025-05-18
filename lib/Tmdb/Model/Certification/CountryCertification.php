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

namespace Tmdb\Model\Certification;

use Tmdb\Model\AbstractModel;

/**
 * Class CountryCertification.
 */
class CountryCertification extends AbstractModel
{
    public static $properties = [
        'certification',
        'meaning',
        'order',
    ];
    /**
     * @var string
     */
    private $certification;
    /**
     * @var string
     */
    private $meaning;
    /**
     * @var int
     */
    private $order;

    /**
     * @return string
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param string $certification
     */
    public function setCertification($certification): static
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * @return string
     */
    public function getMeaning()
    {
        return $this->meaning;
    }

    /**
     * @param string $meaning
     */
    public function setMeaning($meaning): static
    {
        $this->meaning = $meaning;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order): static
    {
        $this->order = $order;

        return $this;
    }
}
