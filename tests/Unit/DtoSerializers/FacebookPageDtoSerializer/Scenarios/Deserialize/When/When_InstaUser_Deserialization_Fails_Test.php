<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\InstaUserDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when schema changes
 */
class When_InstaUser_Deserialization_Fails_Test extends Given_Deserialize_Is_Called
{

    private array $instaUserInput;

    function setUpClassProperties()
    {
        $this->mockInstaUserDtoSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new InstaUserDtoDeserializationError());
    }

    function fixtureProvider(): array
    {
        $userArray = ["id"=>"123231","followers_count"=>123,"username"=>"example"];

        return [
            [
                "dataIn"=>["instagram_business_account"=>$userArray,"id"=>"12321312"],
                "instaUserInput"=>$userArray
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->instaUserInput=$data["instaUserInput"];
        $this->dataIn=$data["dataIn"];
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_InstaUser_Should_Be_Deserialized_With_Correct(){
        $this->mockInstaUserDtoSerializer
            ->shouldHaveReceived("deserialize")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_InstaUser_Should_Be_Deserialized_Once(){
        $this->mockInstaUserDtoSerializer
            ->shouldHaveReceived("deserialize",[$this->instaUserInput]);
    }

    /**
     * @test
     */
    public function Then_InstaUserDeserializationError_Should_Be_Thrown(){
        self::assertInstanceOf(InstaUserDtoDeserializationError::class,$this->exception);
    }
}