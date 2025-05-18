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

namespace Tmdb\Model;

use Tmdb\Model\Common\GenericCollection;

/**
 * Class Certification.
 */
class Certification extends AbstractModel
{
    public static $properties = [
        'country',
    ];
    /**
     * @var string
     */
    private $country;
    private \Tmdb\Model\Common\GenericCollection $certifications;

    public function __construct()
    {
        $this->certifications = new GenericCollection();
    }

    /**
     * @return GenericCollection
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * @param GenericCollection $certifications
     */
    public function setCertifications($certifications): static
    {
        $this->certifications = $certifications;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country): static
    {
        $this->country = $country;

        return $this;
    }
}
