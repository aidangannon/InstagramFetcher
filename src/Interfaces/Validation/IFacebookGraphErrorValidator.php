<?php

namespace InstaFetcher\Interfaces\Validation;


use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;

/**
 * validates facebook graph errors
 */
interface IFacebookGraphErrorValidator
{
    public function validateCode(): GraphException;
}