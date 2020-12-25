<?php


namespace InstaFetcher\DomainModels\Permission;

/**
 * represents permissions belonging to a facebook graph api session,
 * all permissions have to be unique
 */
class SessionPermissionCollection
{
    /**
     * @var IPermission[]
     */
    private array $permissions;
}