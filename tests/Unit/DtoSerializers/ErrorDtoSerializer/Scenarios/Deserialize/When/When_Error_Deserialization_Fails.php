<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\When;

use InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when an unknown error response is sent from graph api
 * * when facebook graph error schema changes
 */
class When_Error_Deserialization_Fails extends Given_Deserialize_Is_Called
{

    function setUpClassProperties()
    {
        $this->mockErrorMetaSerializer
            ->shouldReceive("deserialize");
    }

    function fixtureProvider(): array
    {
        return [
            ["dataIn"=>["invalidData"=>["data"=>"data","data2"=>"data2"]]],
            ["dataIn"=>["invalidData"=>["data"=>"data","data2"=>"data2"]]]
        ];
    }

    function initFixture(array $data)
    {
        $this->dataIn = $data["dataIn"];
    }
}