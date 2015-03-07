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
namespace Tmdb\Model\Tv;

use Tmdb\Model\AbstractModel;

/**
 * Class ContentRating
 * @package Tmdb\Model\tv
 */
class ContentRating extends AbstractModel
{
    private $id;
    private $iso_3166_1;
    private $rating;

    public static $properties = [
    'id',
    'iso_3166_1',
    'rating',
    ];

    public function __construct($item = null)
    {
        $this->iso_3166_1 = $item['iso_3166_1'];
        $this->id = $item['id'];
        $this->rating = $item['rating'];
    }

    /**
     * @param  mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  string $country
     * @return $this
     */
    public function setIso31661($country)
    {
        $this->iso_3166_1 = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getIso31661()
    {
        return $this->iso_3166_1;
    }

    /**
     * @param  string $rating
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

}
