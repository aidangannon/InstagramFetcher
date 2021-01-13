<?php


namespace InstaFetcher\DataAccess\Dtos;


class ErrorMetaDataDto
{
    public const TYPE_FIELD = "type";
    public const CODE_FIELD = "code";
    public const SUB_CODE_FIELD = "error_subcode";
    public const MESSAGE_FIELD = "message";

    public string $type;
    public int $code;
    public string $message;
    public ?int $subCode;

    public function __construct(string $type, int $code, string $message, ?int $subCode=null)
    {
        $this->type = $type;
        $this->code = $code;
        $this->message = $message;
        $this->subCode = $subCode;
    }


}