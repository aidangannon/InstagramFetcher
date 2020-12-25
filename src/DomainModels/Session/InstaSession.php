<?php
declare(strict_types=1);

namespace InstaFetcher\DomainModels\Session;



use DateTime;
use InstaFetcher\DomainModels\Permission\SessionPermissionCollection;

/**
 * represents a facebook graph api session
 */
class InstaSession
{
    private string $token;

    private DateTime $expiryDate;

    private SessionPermissionCollection $permissions;
}