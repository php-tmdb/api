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
namespace Tmdb\Factory\People;

use Tmdb\Factory\PeopleFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Collection\People\Crew;

/**
 * Class CrewFactory
 * @package Tmdb\Factory\People
 */
class CrewFactory extends PeopleFactory
{
    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        parent::__construct($httpClient);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data = [], $person = null)
    {
        return parent::create($data, $person);
    }

    /**
     * {@inheritdoc}
     * @param \Tmdb\Model\Person\CrewMember $person
     */
    public function createCollection(array $data = [], $person = null)
    {
        $collection = new Crew();

        if (is_object($person)) {
            $class = get_class($person);
        } else {
            $class = '\Tmdb\Model\Person\CrewMember';
        }

        foreach ($data as $item) {
            $collection->add(null, $this->create($item, new $class()));
        }

        return $collection;
    }
}
