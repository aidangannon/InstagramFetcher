<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\FacebookPagesDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when schema changes
 */
class When_Pages_Deserialization_Fails_Test extends Given_Deserialize_Is_Called
{

    function setUpClassProperties()
    {
        $this->mockFacebookPageDtoSerializer
            ->shouldReceive("deserialize");
    }

    function fixtureProvider(): array
    {
        return [
            [
                "dataIn"=>["invalid"=>"not_array","invalid2"=>"12321312"]
            ],
            [
                "dataIn"=>[]
            ],
            [
                "dataIn"=>["data"=>"not array"]
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->dataIn=$data["dataIn"];
    }

    /**
     * @test
     */
    public function Then_FacebookPagesDeserializationError_Should_Be_Thrown(){
        self::assertInstanceOf(FacebookPagesDtoDeserializationError::class,$this->exception);
    }
}