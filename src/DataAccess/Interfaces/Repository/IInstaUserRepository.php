<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Interfaces\Repository;


use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;

/**
 * generic data access for instagram user
 */
interface IInstaUserRepository
{
    /**
     * gets instagram user by instagram handle // username
     */
    public function getByHandle(string $handle): InstaUserModel;

    /**
     * gets instagram user by id
     */
    public function get(string $id): InstaUserModel;
}