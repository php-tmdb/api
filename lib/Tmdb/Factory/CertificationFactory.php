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

namespace Tmdb\Factory;

use Tmdb\Model\Certification;
use Tmdb\Model\Common\GenericCollection;

/**
 * Class CertificationFactory.
 */
class CertificationFactory extends AbstractFactory
{
    #[\Override]
    public function createCollection(array $data = []): GenericCollection
    {
        if (\array_key_exists('certifications', $data)) {
            $data = $data['certifications'];
        }

        $collection = new GenericCollection();

        foreach ($data as $country => $certifications) {
            $certification = new Certification();
            $certification->setCountry($country);

            foreach ($certifications as $countryCertification) {
                $object = $this->create($countryCertification);

                $certification->getCertifications()->add(null, $object);
            }

            $collection->add(null, $certification);
        }

        return $collection;
    }

    #[\Override]
    public function create(array $data = []): Certification\CountryCertification
    {
        return $this->hydrate(new Certification\CountryCertification(), $data);
    }
}
