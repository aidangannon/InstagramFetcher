<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\FacebookPagesDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when schema changes
 */
class When_Page_Deserialization_Fails_Test extends Given_Deserialize_Is_Called
{

    function setUpClassProperties()
    {
        $this->mockInstaUserDtoSerializer
            ->shouldReceive("deserialize");
    }

    function fixtureProvider(): array
    {
        return [
            [
                "dataIn"=>["invalid"=>"not_array","invalid2"=>"12321312"]
            ],
            [
                "dataIn"=>["instagram_business_account"=>[],"id"=>12321312]
            ],
            [
                "dataIn"=>["instagram_business_account"=>[]]
            ],
            [
                "dataIn"=>["instagram_business_account"=>"not_array","id"=>"12321312"]
            ],
            [
                "dataIn"=>["id"=>"12321312"]
            ],
            [
                "dataIn"=>[]
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