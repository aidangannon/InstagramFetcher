<?php


namespace InstaFetcherTests\Smoke\FacebookGraphApi;


use Exception;
use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\Serializers\ErrorDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\ErrorMetaDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\FacebookPageDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\FacebookPagesDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\InstaUserDtoSerializer;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcher\DataAccess\Http\SymfonyHttp\FacebookPageSymfonyHttpDao;
use InstaFetcherTests\UnitTestCase;
use Symfony\Component\HttpClient\HttpClient;

class GetOpenGraphUserPagesTest extends UnitTestCase
{
    /**
     * TODO: re-auth
     * @non-test
     */
    public function Fetch_Pages_Successfully(){

        //arrange
        $pagesDao =  new FacebookPageSymfonyHttpDao(
            $_ENV['APP_ID'],
            $_ENV['APP_SECRET'],
            $_ENV['BASE_URL'],
            HttpClient::create(),
            new ErrorDtoSerializer(
                new ErrorMetaDtoSerializer()
            ),
            new FacebookPagesDtoSerializer(
                new FacebookPageDtoSerializer(
                    new InstaUserDtoSerializer()
                )
            )
        );
        $expectedPages = new FacebookPagesDto([]);

        //act
        $actualPages = $pagesDao->getInstaAccounts($_ENV['OPEN_GRAPH_USER_TOKEN']);

        //assert
        self::assertEquals($expectedPages,$actualPages);
    }

    /**
     * @test
     */
    public function Fetch_Invalid_Token(){

        $exception = new Exception;

        //arrange
        $pagesDao =  new FacebookPageSymfonyHttpDao(
            $_ENV['APP_ID'],
            $_ENV['APP_SECRET'],
            $_ENV['BASE_URL'],
            HttpClient::create(),
            new ErrorDtoSerializer(
                new ErrorMetaDtoSerializer()
            ),
            new FacebookPagesDtoSerializer(
                new FacebookPageDtoSerializer(
                    new InstaUserDtoSerializer()
                )
            )
        );

        //act
        try{
            $pagesDao->getInstaAccounts("InvalidToken");
            self::fail("graph exception should have occurred");
        }
        catch(GraphException $e){

            $exception = $e;

            //assert
            self::assertEquals(
                new ErrorDto(
                    new ErrorMetaDataDto(
                        "OAuthException",
                        190,
                        "Invalid OAuth access token."
                    )
                ),
                $e->getGraphError()
            );
        }

        //assert
        self::assertInstanceOf(GraphException::class,$exception);
    }
}