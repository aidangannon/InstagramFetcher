<?php


namespace InstaFetcher\DomainModels\Permission;

/**
 * represents permissions belonging to a facebook graph api session,
 * all permissions have to be unique
 */
class SessionPermissionCollectionModel
{
    /**
     * @var IPermissionModel[]
     */
    private array $permissions;
}