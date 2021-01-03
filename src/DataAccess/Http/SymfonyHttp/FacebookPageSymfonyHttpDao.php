<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Http\SymfonyHttp;


use HttpException;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\FacebookGraphErrorValidator;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPagesDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IFacebookPageDao;
use InstaFetcher\Interfaces\Validation\IFacebookGraphErrorValidator;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FacebookPageSymfonyHttpDao extends FacebookGraphSymfonyHttpDao implements IFacebookPageDao
{

    private HttpClientInterface $httpClient;
    private IErrorDtoSerializer $errorSerializer;
    private IFacebookPagesDtoSerializer $pagesSerializer;

    public function __construct(
        int $appId,
        string $appSecret,
        string $baseUrl,
        HttpClientInterface $httpClient,
        IErrorDtoSerializer $errorSerializer,
        IFacebookPagesDtoSerializer $pagesSerializer
    )
    {
        parent::__construct($appId,$appSecret,$baseUrl);
        $this->httpClient = $httpClient;
        $this->errorSerializer = $errorSerializer;
        $this->pagesSerializer = $pagesSerializer;
    }

    public function getInstaAccounts(string $token): FacebookPagesDto
    {
        $url = $this->baseUrl."me/accounts?".
            "fields=instagram_business_account{username,followers_count}&".
            "access_token={$token}&".
            "appsecret_proof=".$this->generateAppSecretProof($token);

        $response = $this->httpClient->request("GET",$url);

        $code = $response->getStatusCode();

        switch($code){
            case 200:
                return $this->pagesSerializer->deserialize($response->toArray(false));
            default:
                $error = $this->errorSerializer->deserialize($response->toArray(false));
                throw new GraphException($error);
        }
    }
}