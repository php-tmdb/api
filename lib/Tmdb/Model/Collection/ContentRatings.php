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
namespace Tmdb\Model\Collection;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\tv\ContentRating;
use Tmdb\Model\AbstractModel;

/**
 * Class ContentRatings
 * @package Tmdb\Model\Collection
 */
class ContentRatings extends GenericCollection
{
    /**
     * Returns all content Ratings
     *
     * @return ContentRatings[]
     */
    public function getContentRatings()
    {
        return $this->data;
    }

    /**
     * Retrieve a content rating from the collection
     *
     * @param $id
     * @return ContentRating|null
     */
    public function getContentRating($country)
    {
        $data = get_object_vars($this);

        foreach ($data['data'] as $item) {
            if ($item->getIso31661() == $country) {
                return $item->getRating();
            }
        }

        return null;
    }

    /**
     * Add a genre to the collection
     *
     * @param  ContentRating $contentRating
     * @return $this
     */
    public function addContentRating(ContentRating $contentRating)
    {
        $this->data[] = $contentRating;

        return $this;
    }
}
