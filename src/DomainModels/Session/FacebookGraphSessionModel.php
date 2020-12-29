<?php
declare(strict_types=1);

namespace InstaFetcher\DomainModels\Session;



use BadMethodCallException;
use DateTime;
use InstaFetcher\DomainModels\Permission\IPermissionModel;
use InstaFetcher\DomainModels\Permission\SessionPermissionCollectionModel;

/**
 * represents a facebook graph api session
 */
class FacebookGraphSessionModel
{
    private string $token;

    private DateTime $expiryDate;

    private SessionPermissionCollectionModel $permissions;

    public function getExpiryDate(): DateTime{
        return $this->expiryDate;
    }

    public function getToken(): string{
        return $this->token;
    }

    /**
     * @return array|IPermissionModel[]
     */
    public function getPermissions(): array{
        throw new BadMethodCallException("not implemented");
    }
}