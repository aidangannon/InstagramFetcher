<?php

namespace InstaFetcherTests\Unit\DataAccess\DTOs\Insights;

use InstaFetcher\DataAccess\DTOs\InsightDTO;
use InstaFetcher\DataAccess\DTOs\InsightsDTO;
use InvalidArgumentException;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class InsightsDTOTest extends TestCase
{

    public function test_hydrateExtra_allFieldsPopulated(){

        //arrange
        $expectedInsight = new InsightDTO();
        $expectedInsight->value = ['GB'=>1,'US'=>9];
        $expectedValues=[$expectedInsight];
        $data = [
            "name"=>"audience_country",
            "values"=>[['value'=>['GB'=>1,'US'=>9]]],
            "title"=>"Audience Country",
            "description"=>"The countries of this profile's audience"
        ];

        //act
        $insights = InsightsDTO::hydrate($data);

        //assert
        $this->assertEquals('audience_country',$insights->name);
        $this->assertEquals($expectedValues,$insights->values);
    }

    public function test_hydrateCompletely_allFieldsPopulated(){

        //arrange
        $expectedInsight = new InsightDTO();
        $expectedInsight->value = ['GB'=>1,'US'=>9];
        $expectedValues=[$expectedInsight];
        $data = ["name"=>"audience_country","values"=>[['value'=>['GB'=>1,'US'=>9]]]];

        //act
        $insights = InsightsDTO::hydrate($data);

        //assert
        $this->assertEquals('audience_country',$insights->name);
        $this->assertEquals($expectedValues,$insights->values);
    }

    /**
     * @dataProvider hydrateIncomplete_dataProvider
     */
    public function test_hydrateIncomplete_outOfBoundsExceptionThrown(array $data){

        $this->expectException(OutOfBoundsException::class);

        //act
        InsightsDTO::hydrate($data);
    }

    public function hydrateIncomplete_dataProvider(){

        return [
            [["name"=>"audience_country"]],
            [["values"=>[["value"=>[]]]]],
            [[]]
        ];
    }

    public function test_hydrate_valuesIsNotTypeArray_illegalArgumentException(){

        $this->expectException(InvalidArgumentException::class);

        //arrange
        $data = ["values"=>"random_string"];

        //act
        InsightsDTO::hydrate($data);
    }
}
