<?php


namespace InstaFetcher\DataAccess\Http\Repository;


use BadMethodCallException;
use InstaFetcher\DataAccess\Interfaces\Http\Dao\IFacebookPageDao;
use InstaFetcher\DataAccess\Interfaces\Http\Dao\IInstaUserDao;
use InstaFetcher\DataAccess\Interfaces\Repository\IInstaUserRepository;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;

/**
 * http data access implementation for instagram user
 */
class InstaUserHttpRepository implements IInstaUserRepository
{

    private FacebookGraphSessionModel $session;
    private IFacebookPageDao $pageDao;
    private IInstaUserDao $userDao;

    public function __construct(FacebookGraphSessionModel $session, IFacebookPageDao $pagesDao, IInstaUserDao $userDao)
    {
        $this->session = $session;
        $this->pageDao = $pagesDao;
        $this->userDao = $userDao;
    }

    public function getByHandle(string $handle): InstaUserModel
    {
        throw new BadMethodCallException("not implemented");
    }

    public function get(string $id): InstaUserModel
    {
        throw new BadMethodCallException("not implemented");
    }
}