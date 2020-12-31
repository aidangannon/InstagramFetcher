<?php


namespace InstaFetcher\DataAccess\Dtos;


class ErrorDto
{
    public const ERROR_FIELD = "error";

    public ErrorMetaDataDto $error;

    public function __construct(ErrorMetaDataDto $error)
    {
        $this->error = $error;
    }


}