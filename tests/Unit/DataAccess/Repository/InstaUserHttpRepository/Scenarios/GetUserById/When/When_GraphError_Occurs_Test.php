<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\Given_User_Tries_To_Get_Insta_User_By_Id;

/**
 * @testdox Given User Tries To Get Insta User By Id, When Graph Error Occurs (DataAccess/Repository)
 */
class When_GraphError_Occurs_Test extends Given_User_Tries_To_Get_Insta_User_By_Id
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
                "tokenException"=>new GraphException(new ErrorDto(new ErrorMetaDataDto("OAuthError",190,"message",0))),
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
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Token_Was_Received_From_Facebook_Session()
    {
        $this->mockSession
            ->shouldHaveReceived("getToken");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Insta_User_Was_Attempted_To_Be_Fetched()
    {
        $this->mockUserDao
            ->shouldHaveReceived("getInstaInfo", [$this->id,$this->token]);
        $this->mockUserDao
            ->shouldHaveReceived("getInstaInfo")
            ->once();
    }

    /**
     * @test
     */
    public function Then_Token_Not_Authorized_Error_Occurs(){
        self::assertEquals($this->tokenException,$this->exception);
    }
}