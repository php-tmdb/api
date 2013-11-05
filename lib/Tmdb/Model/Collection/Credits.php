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

use Tmdb\Model\Collection\People\Cast;
use Tmdb\Model\Collection\People\Crew;

class Credits {
    /**
     * @var Cast
     */
    public $cast;

    /**
     * @var Crew
     */
    private $crew;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cast = new Cast();
        $this->crew = new Crew();
    }

    /**
     * @param \Tmdb\Model\Collection\People\Cast $cast
     * @return $this
     */
    public function setCast($cast)
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\People\Cast
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @param \Tmdb\Model\Collection\People\Crew $crew
     * @return $this
     */
    public function setCrew($crew)
    {
        $this->crew = $crew;
        return $this;
    }

    /**
     * @return \Tmdb\Model\Collection\People\Crew
     */
    public function getCrew()
    {
        return $this->crew;
    }


}