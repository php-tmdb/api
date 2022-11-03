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

namespace Tmdb\Factory;

use RuntimeException;
use Tmdb\Factory\Account\AvatarFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Account;
use Tmdb\Model\Lists\Result;

/**
 * Class AccountFactory
 * @package Tmdb\Factory
 */
class AccountFactory extends AbstractFactory
{
    /**
     * @var MovieFactory
     */
    private $movieFactory;

    /**
     * @var ImageFactory
     */
    private $imageFactory;

    /**
     * @var TvFactory
     */
    private $tvFactory;

    /**
     * @var AvatarFactory
     */
    private $avatarFactory;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->movieFactory = new MovieFactory($httpClient);
        $this->imageFactory = new ImageFactory($httpClient);
        $this->tvFactory = new TvFactory($httpClient);
        $this->avatarFactory = new AvatarFactory($httpClient);

        parent::__construct($httpClient);
    }

    /**
     * @param array $data
     *
     * @return Account
     */
    public function create(array $data = []): Account
    {
        $account = new Account();

        if (array_key_exists('avatar', $data)) {
            $account->setAvatar(
                $this->getAvatarFactory()->createCollection($data['avatar'])
            );
        }

        return $this->hydrate($account, $data);
    }

    /**
     * @return AvatarFactory
     */
    public function getAvatarFactory()
    {
        return $this->avatarFactory;
    }

    /**
     * @param array $data
     *
     * @return Result
     */
    public function createStatusResult(array $data = [])
    {
        return $this->hydrate(new Result(), $data);
    }

    /**
     * Create movie
     *
     * @param array $data
     *
     * @return AbstractModel|null
     */
    public function createMovie(array $data = []): ?AbstractModel
    {
        return $this->getMovieFactory()->create($data);
    }

    /**
     * @return MovieFactory
     */
    public function getMovieFactory()
    {
        return $this->movieFactory;
    }

    /**
     * @param MovieFactory $movieFactory
     * @return self
     */
    public function setMovieFactory($movieFactory)
    {
        $this->movieFactory = $movieFactory;

        return $this;
    }

    /**
     * Create TV show
     *
     * @param array $data
     *
     * @return AbstractModel|null
     */
    public function createTvShow(array $data = []): ?AbstractModel
    {
        return $this->getTvFactory()->create($data);
    }

    /**
     * @return TvFactory
     */
    public function getTvFactory()
    {
        return $this->tvFactory;
    }

    /**
     * @param TvFactory $tvFactory
     * @return self
     */
    public function setTvFactory($tvFactory)
    {
        $this->tvFactory = $tvFactory;

        return $this;
    }

    /**
     * Create list item
     *
     * @param array $data
     * @return AbstractModel
     */
    public function createListItem(array $data = [])
    {
        $listItem = new Account\ListItem();

        if (array_key_exists('poster_path', $data)) {
            $listItem->setPosterImage($this->getImageFactory()->createFromPath($data['poster_path'], 'poster_path'));
        }

        return $this->hydrate($listItem, $data);
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
     * @return self
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = [])
    {
        throw new RuntimeException(sprintf(
            'Class "%s" does not support method "%s".',
            __CLASS__,
            __METHOD__
        ));
    }

    /**
     * @param AvatarFactory $avatarFactory
     * @return self
     */
    public function setAvatarFactory($avatarFactory)
    {
        $this->avatarFactory = $avatarFactory;

        return $this;
    }
}
