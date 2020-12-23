<?php

namespace InstaFetcherTests\Unit\DataAccess\DTOs\Insights;

use InstaFetcher\DataAccess\DTOs\InsightDTO;
use InstaFetcher\DataAccess\DTOs\InsightsDTO;
use PHPUnit\Framework\TestCase;

class InsightsDTOTest extends TestCase
{
    public function test_hydrate_completely_allFieldsPopulated(){

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

    public function test_hydrateName_namePopulated(){

        //arrange
        $data = ["name"=>"audience_country"];

        //act
        $insights = InsightsDTO::hydrate($data);

        //assert
        $this->assertEquals('audience_country',$insights->name);
        $this->assertEmpty($insights->values);
    }

    public function test_hydrateValues_valuesPopulated(){

        //arrange
        $expectedInsight = new InsightDTO();
        $expectedInsight->value = ['GB'=>1,'US'=>9];
        $expectedValues=[$expectedInsight];
        $data = ["values"=>[['value'=>['GB'=>1,'US'=>9]]]];

        //act
        $insights = InsightsDTO::hydrate($data);

        //assert
        $this->assertNull($insights->name);
        $this->assertEquals($expectedValues,$insights->values);
    }
}
