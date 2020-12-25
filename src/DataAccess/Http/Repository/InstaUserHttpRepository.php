<?php


namespace InstaFetcher\DataAccess\Http\Repository;


use BadMethodCallException;
use InstaFetcher\DataAccess\Interfaces\Http\IFacebookGraphCaller;
use InstaFetcher\DataAccess\Interfaces\Repository\IInstaUserRepository;
use InstaFetcher\DomainModels\InstaUser\InstaUser;
use InstaFetcher\DomainModels\Session\InstaSession;

/**
 * http data access implementation for instagram user
 */
class InstaUserHttpRepository implements IInstaUserRepository
{

    private IFacebookGraphCaller $caller;

    public function __construct(IFacebookGraphCaller $caller){
        $this->caller=$caller;
    }

    public function getByHandle(string $handle,InstaSession $session): InstaUser
    {
        throw new BadMethodCallException("not implemented");
    }

    public function get(string $id,InstaSession $session): InstaUser
    {
        throw new BadMethodCallException("not implemented");
    }
}