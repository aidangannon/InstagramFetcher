<?php


namespace InstaFetcher\DataAccess\Http\SymfonyHttp;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IInstaUserDao;
use InstaFetcher\Interfaces\Validation\IFacebookGraphErrorValidator;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InstaUserSymfonyHttpDao implements IInstaUserDao
{

    private HttpClientInterface $httpClient;
    private IFacebookGraphErrorValidator $errorValidator;
    private IErrorDtoSerializer $errorSerializer;
    private IInstaUserDtoSerializer $userSerializer;

    public function __construct(HttpClientInterface $httpClient, IFacebookGraphErrorValidator $errorValidator, IErrorDtoSerializer $errorSerializer, IInstaUserDtoSerializer $userSerializer)
    {
        $this->httpClient = $httpClient;
        $this->errorValidator = $errorValidator;
        $this->errorSerializer = $errorSerializer;
        $this->userSerializer = $userSerializer;
    }

    public function getInstaInfo(string $instaId, string $token): InstaUserDto
    {
        throw new \BadMethodCallException("not implemented");
    }
}