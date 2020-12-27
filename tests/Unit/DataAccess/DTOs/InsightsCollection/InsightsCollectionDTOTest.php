<?php

namespace InstaFetcherTests\Unit\DataAccess\DTOs\InsightsCollection;

use InstaFetcher\DataAccess\DTOs\InsightDTO;
use InstaFetcher\DataAccess\DTOs\InsightsCollectionDTO;
use InstaFetcher\DataAccess\DTOs\InsightsDTO;
use InvalidArgumentException;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class InsightsCollectionDTOTest extends TestCase
{
    public function test_hydrate_completely_allFieldsPopulated(){

        //arrange
        $expectedInsight = new InsightDTO();
        $expectedInsight->value = ['GB'=>1,'US'=>9];
        $expectedValues=[$expectedInsight];
        $expectedInsights = new InsightsDTO();
        $expectedInsights->name = "audience_country";
        $expectedInsights->values = $expectedValues;
        $expectedData = [$expectedInsights];
        $data = ["data"=>[["name"=>"audience_country","values"=>[['value'=>['GB'=>1,'US'=>9]]]]]];

        //act
        $insightsCollection = InsightsCollectionDTO::hydrate($data);

        //assert
        $this->assertEquals($expectedData,$insightsCollection->data);
    }

    public function test_hydrateIncomplete_outOfBoundsExceptionThrown(){

        $this->expectException(OutOfBoundsException::class);

        //act
        InsightsCollectionDTO::hydrate([]);
    }

    public function test_hydrate_dataIsNotTypeArray_illegalArgumentException(){

        $this->expectException(InvalidArgumentException::class);

        //arrange
        $data = ["data"=>"random_string"];

        //act
        InsightsCollectionDTO::hydrate($data);
    }
}
