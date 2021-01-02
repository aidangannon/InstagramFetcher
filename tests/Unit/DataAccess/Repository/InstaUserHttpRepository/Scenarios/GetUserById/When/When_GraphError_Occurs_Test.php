<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\Given_User_Tries_To_Get_User_By_Id;

class When_GraphError_Occurs_Test extends Given_User_Tries_To_Get_User_By_Id
{

    private GraphException $tokenException;

    public function setUpClassProperties()
    {
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns($this->token);
        $this->mockUserDao
            ->shouldReceive("getInstaInfo")
            ->with($this->id,$this->token)
            ->andThrow($this->tokenException);
    }

    public function fixtureProvider(): array
    {
        $token = "11111";

        return [
            [
                "tokenException"=>new GraphException(new ErrorDto(new ErrorMetaDataDto("OAuthError",190,0))),
                "token"=>$token,
                "id"=>"33333"
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->tokenException=$data["tokenException"];
        $this->token=$data["token"];
        $this->id=$data["id"];
    }

    /**
     * @test
     */
    public function Then_TokenNotAuthorized_Exception_Is_Thrown(){
        self::assertEquals($this->tokenException,$this->exception);
    }
}