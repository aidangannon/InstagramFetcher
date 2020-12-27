<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\DTOs\InstaUser;

use InstaFetcher\DataAccess\DTOs\InstaUserDto;
use InstaFetcher\DataAccess\DTOs\Mapper\InstaUserDtoMapper;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class InstaUserDTOTest extends TestCase
{

    public function test_hydrateWithExtraFields_allFieldsPopulated(){

        //arrange
        $data = ['id'=>'12322321','followers_count'=>100,'follows_count','name'=>'Aidan Gannon','username'=>'aidan'];

        //act
        $user = InstaUserDtoMapper::hydrate($data);

        //assert
        $this->assertEquals('12322321',$user->id);
        $this->assertEquals(100,$user->followersCount);
    }

    public function test_hydrateCompletely_allFieldsPopulated(){

        //arrange
        $data = ['id'=>'12322321','followers_count'=>100];

        //act
        $user = InstaUserDtoMapper::hydrate($data);

        //assert
        $this->assertEquals('12322321',$user->id);
        $this->assertEquals(100,$user->followersCount);
    }

    /**
     * @dataProvider hydrateIncomplete_dataProvider
     */
    public function test_hydrateIncomplete_outOfBoundsExceptionThrown(array $data){

        $this->expectException(OutOfBoundsException::class);

        //act
        InstaUserDtoMapper::hydrate($data);
    }

    public function hydrateIncomplete_dataProvider(){

        return [
            [['id'=>'12322321']],
            [['followers_count'=>100]],
            [[]]
        ];
    }

}
