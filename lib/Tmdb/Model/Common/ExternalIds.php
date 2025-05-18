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

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;

/**
 * Class ExternalIds.
 */
class ExternalIds extends AbstractModel
{
    public static $properties = [
        'imdb_id',
        'freebase_id',
        'freebase_mid',
        'id',
        'tvdb_id',
        'tvrage_id',
    ];
    private $imdbId;
    private $freebaseId;
    private $freebaseMid;
    private ?int $id = null;
    private $tvdbId;
    private $tvrageId;

    public function getFreebaseId()
    {
        return $this->freebaseId;
    }

    public function setFreebaseId($freebaseId): static
    {
        $this->freebaseId = $freebaseId;

        return $this;
    }

    public function getFreebaseMid()
    {
        return $this->freebaseMid;
    }

    public function setFreebaseMid($freebaseMid): static
    {
        $this->freebaseMid = $freebaseMid;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): static
    {
        $this->id = (int) $id;

        return $this;
    }

    public function getImdbId()
    {
        return $this->imdbId;
    }

    public function setImdbId($imdbId): static
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    public function getTvdbId()
    {
        return $this->tvdbId;
    }

    public function setTvdbId($tvdbId): static
    {
        $this->tvdbId = $tvdbId;

        return $this;
    }

    public function getTvrageId()
    {
        return $this->tvrageId;
    }

    public function setTvrageId($tvrageId): static
    {
        $this->tvrageId = $tvrageId;

        return $this;
    }
}
