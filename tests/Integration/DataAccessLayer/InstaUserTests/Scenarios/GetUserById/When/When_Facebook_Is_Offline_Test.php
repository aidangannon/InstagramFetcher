<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserById\When;


use InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserById\Given_User_Tries_To_Get_Insta_User_By_Id;
use Symfony\Component\HttpClient\Exception\TransportException;

class When_Facebook_Is_Offline_Test extends Given_User_Tries_To_Get_Insta_User_By_Id
{
    function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrow(TransportException::class);
    }

    function fixtureProvider(): array
    {
        return [
            [
                "id"=>"12344"
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->id=$data["id"];
    }

    /**
     * @test
     */
    public function Then_TransportException_Should_Be_Thrown(){
        self::assertInstanceOf(TransportException::class,$this->exception);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Data_Response_Body_Is_Not_Fetched(){
        $this->mockResponse
            ->shouldNotHaveReceived("toArray");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Correct_Url_Is_Called(){
        $token = self::TEST_ACCESS_TOKEN;
        $this->mockHttpClient
            ->shouldHaveReceived(
                "request",
                [
                    "GET",
                    self::TEST_BASE_URL.$this->id."?fields=id,username,followers_count&access_token={$token}&appsecret_proof=".hash_hmac('sha256', $token, self::TEST_APP_SECRET)]);
    }
}