<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\FacebookPagesDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when schema changes
 */
class When_Page_Deserialization_Fails_Test extends Given_Deserialize_Is_Called
{

    private array $facebookPageInput;

    function setUpClassProperties()
    {
        $this->mockFacebookPageDtoSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new FacebookPagesDtoDeserializationError());
    }

    function fixtureProvider(): array
    {
        $pageArray = [["id"=>"123231"],["id"=>"123231"]];

        return [
            [
                "dataIn"=>["data"=>$pageArray],
                "facebookPageInput"=>$pageArray
            ],
            [
                "dataIn"=>["data"=>[$pageArray[0]]],
                "facebookPageInput"=>[$pageArray[0]]
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->facebookPageInput=$data["facebookPageInput"];
        $this->dataIn=$data["dataIn"];
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_FacebookPage_Should_Be_Attempted_To_Be_Deserialized_Once(){
        $this->mockFacebookPageDtoSerializer
            ->shouldHaveReceived("deserialize")
            ->once();
    }

    /**
     * @test
     */
    public function Then_FacebookPagesDeserializationError_Should_Be_Thrown(){
        self::assertInstanceOf(FacebookPagesDtoDeserializationError::class,$this->exception);
    }
}