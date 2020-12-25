<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Interfaces\Repository;


use InstaFetcher\DomainModels\Session\InstaSession;
use InstaFetcher\DomainModels\InstaUser\InstaUser;

/**
 * generic data access for instagram user
 */
interface IInstaUserRepository
{
    /**
     * gets instagram user by instagram handle // username
     */
    public function getByHandle(string $handle, InstaSession $session): InstaUser;

    /**
     * gets instagram user by id
     */
    public function get(string $id, InstaSession $session): InstaUser;
}