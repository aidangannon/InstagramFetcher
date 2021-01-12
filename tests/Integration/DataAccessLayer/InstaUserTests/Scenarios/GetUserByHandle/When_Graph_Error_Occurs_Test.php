<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserByHandle;


use Exception;
use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\Given_User_Tries_To_Get_Insta_User_By_Handle;

class When_Graph_Error_Occurs_Test extends Given_User_Tries_To_Get_Insta_User_By_Handle
{

    private ErrorDto $expectedError;
    private array $graphErrorResponse;

    function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(400);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->graphErrorResponse);
    }

    function fixtureProvider(): array
    {
        return
        [
            [
                "graphErrorResponse"=>
                [
                    "error"=>
                    [
                        "message"=>"Message describing the error",
                        "type"=>"OAuthException",
                        "code"=>190,
                        "error_subcode"=>460,
                        "error_user_title"=>"A title",
                        "error_user_msg"=>"A message",
                        "fbtrace_id"=>"EJplcsCHuLu"
                    ]
                ],
                "handle"=>"example",
                "expectedError"=>new ErrorDto(
                    new ErrorMetaDataDto(
                        "OAuthException",
                        190,
                        460
                    )
                )
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->expectedError=$data["expectedError"];
        $this->graphErrorResponse=$data["graphErrorResponse"];
        $this->handle=$data["handle"];
    }

    /**
     * @test
     */
    public function Then_GraphException_Is_Thrown(){
        self::assertInstanceOf(GraphException::class,$this->exception);
    }

    /**
     * @test
     */
    public function Then_Error_Matches_Error_Response(){
        self::assertEquals($this->expectedError,$this->getGraphException($this->exception)->getGraphError());
    }

    /**
     * @return GraphException|Exception
     */
    private function getGraphException(Exception $exception): GraphException{
        return $exception;
    }
}