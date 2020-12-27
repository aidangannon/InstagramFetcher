<?php


namespace InstaFetcher\DataAccess\Http\Repository;


use BadMethodCallException;
use InstaFetcher\DataAccess\Interfaces\Http\IFacebookGraphCaller;
use InstaFetcher\DataAccess\Interfaces\Repository\IInstaUserRepository;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;

/**
 * http data access implementation for instagram user
 */
class InstaUserHttpRepository implements IInstaUserRepository
{

    private IFacebookGraphCaller $caller;
    private FacebookGraphSessionModel $session;

    public function __construct(IFacebookGraphCaller $caller, FacebookGraphSessionModel $session){
        $this->caller=$caller;
        $this->session=$session;
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