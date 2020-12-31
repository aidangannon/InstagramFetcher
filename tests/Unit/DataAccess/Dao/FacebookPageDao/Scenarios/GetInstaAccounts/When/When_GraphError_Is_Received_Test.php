<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\TokenExpired;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\TokenNotAuthorised;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;

class When_GraphError_Is_Received_Test extends Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User
{
    private GraphException $graphError;
    private int $graphErrorCode;

    public function setUpClassProperties()
    {
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(400);
        $this->mockResponse
            ->shouldReceive("toArray");
        $this->mockErrorSerializer
            ->shouldReceive("deserialize")
            ->andReturns(new ErrorDto(new ErrorMetaDataDto("",$this->graphErrorCode,1344)));
        $this->mockErrorValidator
            ->shouldReceive("validateCode")
            ->andReturns($this->graphError);
    }

    public function fixtureProvider(): array
    {
        $token = "1111";
        $appSecretProof="11110000";

        return [
            [
                "token"=>$token,
                "appSecretProof"=>$appSecretProof,
                "graphErrorCode"=>190,
                "graphError"=>new TokenExpired($token)
            ],
            [
                "token"=>$token,
                "appSecretProof"=>$appSecretProof,
                "graphErrorCode"=>299,
                "graphError"=>new TokenNotAuthorised($token)
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token=$data["token"];
        $this->appSecretProof=$data["appSecretProof"];
        $this->graphErrorCode=$data["graphErrorCode"];
        $this->graphError=$data["graphError"];
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Error_Code_Must_Be_Validated()
    {
        $this->mockErrorValidator
            ->shouldHaveReceived("validateCode",[$this->graphErrorCode]);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Error_Should_Be_Deserialized()
    {
        $this->mockErrorSerializer
            ->shouldHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_GraphException_Should_Be_Thrown()
    {
        self::assertEquals($this->graphError,$this->exception);
    }

}