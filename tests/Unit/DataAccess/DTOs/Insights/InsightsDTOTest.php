<?php

namespace InstaFetcherTests\Unit\DataAccess\DTOs\Insights;

use InstaFetcher\DataAccess\DTOs\InsightDTO;
use InstaFetcher\DataAccess\DTOs\InsightsDTO;
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

    public function test_onlyHydrateName_outOfBoundsExceptionThrown(){

        $this->expectException(OutOfBoundsException::class);

        //arrange
        $data = ["name"=>"audience_country"];

        //act
        InsightsDTO::hydrate($data);
    }

    public function test_onlyHydrateValues_outOfBoundsExceptionThrown(){

        $this->expectException(OutOfBoundsException::class);

        //arrange
        $data = ["values"=>[['value'=>['GB'=>1,'US'=>9]]]];

        //act
        InsightsDTO::hydrate($data);
    }
}
