<?php


namespace InstaFetcher\DataAccess\Http\SymfonyHttp;


use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\FacebookGraphErrorValidator;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IFacebookPageDao;
use InstaFetcher\Interfaces\Validation\IFacebookGraphErrorValidator;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FacebookPageSymfonyHttpDao extends FacebookGraphSymfonyHttpDao implements IFacebookPageDao
{

    private HttpClientInterface $httpClient;
    private IFacebookGraphErrorValidator $errorValidator;
    private IErrorDtoSerializer $errorSerializer;
    private IFacebookPageDtoSerializer $pageSerializer;

    public function __construct(
        int $appId,
        string $appSecret,
        string $baseUrl,
        HttpClientInterface $httpClient,
        IFacebookGraphErrorValidator $errorValidator,
        IErrorDtoSerializer $errorSerializer,
        IFacebookPageDtoSerializer $pageSerializer
    )
    {
        parent::__construct($appId,$appSecret,$baseUrl);
        $this->httpClient = $httpClient;
        $this->errorValidator = $errorValidator;
        $this->errorSerializer = $errorSerializer;
        $this->pageSerializer = $pageSerializer;
    }


    public function getInstaAccounts(string $token): FacebookPagesDto
    {
        throw new \BadMethodCallException("not implemented");
    }
}