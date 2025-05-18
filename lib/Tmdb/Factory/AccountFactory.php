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

use RuntimeException;
use Tmdb\Factory\Account\AvatarFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Account;
use Tmdb\Model\Lists\Result;

/**
 * Class AccountFactory.
 *
 * @extends AbstractFactory<Account>
 */
class AccountFactory extends AbstractFactory
{
    private \Tmdb\Factory\MovieFactory $movieFactory;

    private \Tmdb\Factory\ImageFactory $imageFactory;

    private \Tmdb\Factory\TvFactory $tvFactory;

    private \Tmdb\Factory\Account\AvatarFactory $avatarFactory;

    /**
     * Constructor.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->movieFactory = new MovieFactory($httpClient);
        $this->imageFactory = new ImageFactory($httpClient);
        $this->tvFactory = new TvFactory($httpClient);
        $this->avatarFactory = new AvatarFactory($httpClient);

        parent::__construct($httpClient);
    }

    #[\Override]
    public function create(array $data = []): Account
    {
        $account = new Account();

        if (\array_key_exists('avatar', $data)) {
            $account->setAvatar(
                $this->getAvatarFactory()->createCollection($data['avatar']),
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
     * @return Result
     */
    public function createStatusResult(array $data = [])
    {
        return $this->hydrate(new Result(), $data);
    }

    /**
     * Create movie.
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
     */
    public function setMovieFactory($movieFactory): static
    {
        $this->movieFactory = $movieFactory;

        return $this;
    }

    /**
     * Create TV show.
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
     */
    public function setTvFactory($tvFactory): static
    {
        $this->tvFactory = $tvFactory;

        return $this;
    }

    /**
     * Create list item.
     *
     * @return AbstractModel
     */
    public function createListItem(array $data = [])
    {
        $listItem = new Account\ListItem();

        if (\array_key_exists('poster_path', $data)) {
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
     */
    public function setImageFactory($imageFactory): static
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }

    #[\Override]
    public function createCollection(array $data = []): void
    {
        throw new RuntimeException(\sprintf('Class "%s" does not support method "%s".', self::class, __METHOD__));
    }

    /**
     * @param AvatarFactory $avatarFactory
     */
    public function setAvatarFactory($avatarFactory): static
    {
        $this->avatarFactory = $avatarFactory;

        return $this;
    }
}
