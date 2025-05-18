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

use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Company;

/**
 * Class CompanyFactory.
 */
class CompanyFactory extends AbstractFactory
{
    /**
     * @var ImageFactory|mixed
     */
    private $imageFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->imageFactory = new ImageFactory($httpClient);

        parent::__construct($httpClient);
    }

    #[\Override]
    public function create(array $data = []): Company
    {
        $company = new Company();

        if (\array_key_exists('logo_path', $data)) {
            $company->setLogoImage($this->getImageFactory()->createFromPath($data['logo_path'], 'logo_path'));
        }

        return $this->hydrate($company, $data);
    }

    /**
     * @return ImageFactory
     */
    public function getImageFactory()
    {
        return $this->imageFactory;
    }

    /**
     * @param ImageFactory $imageFactory
     */
    public function setImageFactory($imageFactory): static
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }

    #[\Override]
    public function createCollection(array $data = []): GenericCollection
    {
        return new GenericCollection();
    }
}
