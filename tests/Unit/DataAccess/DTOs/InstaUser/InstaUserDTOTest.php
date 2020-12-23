<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\DTOs\InstaUser;

use InstaFetcher\DataAccess\DTOs\InstaUserDTO;
use PHPUnit\Framework\TestCase;
use Pinq\Traversable;
use Webmozart\Assert\Assert;

class InstaUserDTOTest extends TestCase
{

    public function test_hydrateWithExtraFields_allFieldsPopulated(){

        //arrange
        $data = ['id'=>'12322321','followers_count'=>100,'follows_count','name'=>'Aidan Gannon','username'=>'bigaidangan'];

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

    public function test_hydrateId_idPopulated(){

        //arrange
        $data = ['id'=>'12322321'];

        //act
        $user = InstaUserDTO::hydrate($data);

        //assert
        $this->assertEquals('12322321',$user->id);
        $this->assertNull($user->followersCount);
    }

    public function test_hydrateFollowers_followersPopulated(){

        //arrange
        $data = ['followers_count'=>100];

        //act
        $user = InstaUserDTO::hydrate($data);

        //assert
        $this->assertNull($user->id);
        $this->assertEquals(100,$user->followersCount);
    }

}
