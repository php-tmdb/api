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

namespace Tmdb\Model\Collection;

use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Keyword;

/**
 * Class Keywords.
 *
 * @extends GenericCollection<Keyword>
 */
class Keywords extends GenericCollection
{
    /**
     * Returns all keywords.
     *
     * @return array
     */
    public function getKeywords()
    {
        return $this->data;
    }

    /**
     * Retrieve a keyword from the collection.
     */
    public function getKeyword($id): ?Keyword
    {
        return $this->filterId($id);
    }

    /**
     * Add a keyword to the collection.
     */
    public function addKeyword(Keyword $keyword): void
    {
        $this->data[] = $keyword;
    }
}
