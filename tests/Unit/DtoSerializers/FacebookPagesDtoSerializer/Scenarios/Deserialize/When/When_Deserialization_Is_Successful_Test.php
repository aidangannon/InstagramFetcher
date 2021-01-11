<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when schema remains the same
 */
class When_Deserialization_Is_Successful_Test extends Given_Deserialize_Is_Called
{

    private array $facebookPageInputArray;

    /**
     * @var FacebookPageDto[]
     */
    private array $facebookPageReturnList;
    private FacebookPagesDto $pagesReturn;

    function setUpClassProperties()
    {
        $this->mockFacebookPageDtoSerializer
            ->shouldReceive("deserialize")
            ->andReturn(...$this->facebookPageReturnList);
    }

    function fixtureProvider(): array
    {
        $facebookPageArray = [["id"=>"123231"],["id"=>"232312"],["id"=>"5554444"]];
        $facebookPageDtoArray = [new FacebookPageDto("123231"),new FacebookPageDto("232312"),new FacebookPageDto("5554444")];

        return
            [
                [
                    "dataIn"=>["data"=>$facebookPageArray],
                    "facebookPageInputArray"=>$facebookPageArray,
                    "facebookPageReturnList"=>$facebookPageDtoArray,
                    "pagesReturn"=>new FacebookPagesDto($facebookPageDtoArray)
                ],
                [
                    "dataIn"=>["data"=>[$facebookPageArray[0]]],
                    "facebookPageInputArray"=>[$facebookPageArray[0]],
                    "facebookPageReturnList"=>[$facebookPageDtoArray[0]],
                    "pagesReturn"=>new FacebookPagesDto([$facebookPageDtoArray[0]])
                ]
            ];
    }

    function initFixture(array $data)
    {
        $this->pagesReturn=$data["pagesReturn"];
        $this->facebookPageInputArray=$data["facebookPageInputArray"];
        $this->facebookPageReturnList=$data["facebookPageReturnList"];
        $this->dataIn=$data["dataIn"];
    }

    /**
     * @test
     */
    public function Then_Page_Should_Be_Returned(){
        self::assertEquals($this->pagesReturn,$this->result);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Each_FacebookPage_Should_Be_Deserialized_With_Correct_Args(){
        foreach($this->facebookPageInputArray as $facebookPage) {
            $this->mockFacebookPageDtoSerializer
                ->shouldHaveReceived("deserialize", [$facebookPage]);
        }
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_FacebookPage_Should_Be_Deserialized_For_Each_Page(){
        $this->mockFacebookPageDtoSerializer
            ->shouldHaveReceived("deserialize")
            ->times(count($this->facebookPageInputArray));
    }
}