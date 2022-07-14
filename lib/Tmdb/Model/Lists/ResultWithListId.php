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
 * @version 4.0.0
 */

namespace Tmdb\Model\Lists;

/**
 * Class ResultWithListId
 * @package Tmdb\Model\Lists
 */
class ResultWithListId extends Result
{
    /**
     * @var array
     */
    public static $properties = [
        'status_code',
        'status_message',
        'list_id'
    ];
    /**
     * @var string
     */
    private $listId;

    /**
     * @return string
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param string $listId
     * @return self
     */
    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }
}
