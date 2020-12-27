<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\DTOs\InstaUser;

use InstaFetcher\DataAccess\DTOs\InstaUserDTO;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class InstaUserDTOTest extends TestCase
{

    public function test_hydrateWithExtraFields_allFieldsPopulated(){

        //arrange
        $data = ['id'=>'12322321','followers_count'=>100,'follows_count','name'=>'Aidan Gannon','username'=>'aidan'];

        //act
        $user = InstaUserDTO::hydrate($data);

        //assert
        $this->assertEquals('12322321',$user->id);
        $this->assertEquals(100,$user->followersCount);
    }

    public function test_hydrateCompletely_allFieldsPopulated(){

        //arrange
        $data = ['id'=>'12322321','followers_count'=>100];

        //act
        $user = InstaUserDTO::hydrate($data);

        //assert
        $this->assertEquals('12322321',$user->id);
        $this->assertEquals(100,$user->followersCount);
    }

    public function test_onlyHydrateId_outOfBoundsExceptionThrown(){

        $this->expectException(OutOfBoundsException::class);

        //arrange
        $data = ['id'=>'12322321'];

        //act
        InstaUserDTO::hydrate($data);
    }

    public function test_onlyHydrateFollowers_outOfBoundsExceptionThrown(){

        $this->expectException(OutOfBoundsException::class);

        //arrange
        $data = ['followers_count'=>100];

        //act
        InstaUserDTO::hydrate($data);
    }

}
