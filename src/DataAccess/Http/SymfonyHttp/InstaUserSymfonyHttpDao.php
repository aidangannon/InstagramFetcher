<?php


namespace InstaFetcher\DataAccess\Http\SymfonyHttp;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IInstaUserDao;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InstaUserSymfonyHttpDao extends FacebookGraphSymfonyHttpDao implements IInstaUserDao
{

    private HttpClientInterface $httpClient;
    private IErrorDtoSerializer $errorSerializer;
    private IInstaUserDtoSerializer $userSerializer;

    public function __construct(
        int $appId,
        string $appSecret,
        string $baseUrl,
        HttpClientInterface $httpClient,
        IErrorDtoSerializer $errorSerializer,
        IInstaUserDtoSerializer $userSerializer)
    {
        parent::__construct($appId,$appSecret,$baseUrl);
        $this->httpClient = $httpClient;
        $this->errorSerializer = $errorSerializer;
        $this->userSerializer = $userSerializer;
    }

    public function getInstaInfo(string $instaId, string $token): InstaUserDto
    {
        $url = "{$this->baseUrl}{$instaId}?fields=id,username,followers_count&access_token={$token}&appsecret_proof=".$this->generateAppSecretProof($token);
        $response = $this->httpClient->request("GET",$url);


        $code = $response->getStatusCode();

        switch($code){
            case 200:
                return $this->userSerializer->deserialize($response->toArray());
            default:
                $error = $this->errorSerializer->deserialize($response->toArray());
                throw new GraphException($error);
        }
    }
}