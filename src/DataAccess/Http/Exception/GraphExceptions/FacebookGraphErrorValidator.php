<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Http\Exception\GraphExceptions;

use BadMethodCallException;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcher\Interfaces\Validation\IFacebookGraphErrorValidator;

/**
 * validates facebook graph errors
 */
class FacebookGraphErrorValidator implements IFacebookGraphErrorValidator
{
    public function validateCode(int $code): GraphException
    {
        throw new \BadMethodCallException("not implemented");
    }
}