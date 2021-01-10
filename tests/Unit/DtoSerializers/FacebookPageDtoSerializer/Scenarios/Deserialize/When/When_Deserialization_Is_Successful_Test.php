<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

class When_Deserialization_Is_Successful_Test extends Given_Deserialize_Is_Called
{

    private array $instaUserInput;
    private InstaUserDto $instaUserReturn;
    private FacebookPageDto $pageReturn;

    function setUpClassProperties()
    {
        $this->mockInstaUserDtoSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->instaUserReturn);
    }

    function fixtureProvider(): array
    {
        $userArray = ["id"=>"123231","followers_count"=>123,"username"=>"example"];
        $userDto = new InstaUserDto("123231",123,"example");

        return
            [
                [
                    "dataIn"=>["instagram_business_account"=>$userDto,"id"=>"12321312"],
                    "pageReturn"=>new FacebookPageDto("12321312",$userDto),
                    "instaUserInput"=>$userArray,
                    "instaUserReturn"=>$userDto
                ],
                [
                    "dataIn"=>["instagram_business_account"=>$userDto,"id"=>"12321312","extra_field"=>1231],
                    "pageReturn"=>new FacebookPageDto("12321312",$userDto),
                    "instaUserInput"=>$userArray,
                    "instaUserReturn"=>$userDto
                ]
            ];
    }

    function initFixture(array $data)
    {
        $this->pageReturn=$data["pageReturn"];
        $this->instaUserInput=$data["instaUserInput"];
        $this->instaUserReturn=$data["instaUserReturn"];
        $this->dataIn=$data["dataIn"];
    }

    /**
     * @test
     */
    public function Then_Page_Should_Be_Returned(){
        self::assertEquals($this->pageReturn,$this->result);
    }


    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_InstaUser_Should_Be_Deserialized_With_Correct(){
        $this->mockInstaUserDtoSerializer
            ->shouldHaveReceived("deserialize")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_InstaUser_Should_Be_Deserialized_Once(){
        $this->mockInstaUserDtoSerializer
            ->shouldHaveReceived("deserialize",[$this->instaUserInput]);
    }
}