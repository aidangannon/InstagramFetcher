<?php

namespace InstaFetcherTests\Unit\DataAccess\DTOs\Insight;

use InstaFetcher\DataAccess\DTOs\InsightDTO;
use PHPUnit\Framework\TestCase;

class InsightDTOTest extends TestCase
{

    public function test_hydrateWithExtraFields_allFieldsPopulated(){

        //arrange
        $data = ['value'=>['GB'=>1,'US'=>9],'end_time'=>"2020-12-19T08:00:00+0000"];

        //act
        $insight = InsightDTO::hydrate($data);

        //assert
        $this->assertEquals(['GB'=>1,'US'=>9],$insight->value);
    }

    public function test_hydrateCompletely_allFieldsPopulated(){

        //arrange
        $data = ['value'=>['GB'=>1,'US'=>9]];

        //act
        $insight = InsightDTO::hydrate($data);

        //assert
        $this->assertEquals(['GB'=>1,'US'=>9],$insight->value);
    }
}
