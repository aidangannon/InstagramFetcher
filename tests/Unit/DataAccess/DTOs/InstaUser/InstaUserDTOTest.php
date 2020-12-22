<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\DTOs\InstaUser;

use InstaFetcher\DataAccess\DTOs\InstaUserDTO;
use PHPUnit\Framework\TestCase;
use Pinq\Traversable;
use Webmozart\Assert\Assert;

class InstaUserDTOTest extends TestCase
{

    public function test_hydrate_completely_allFieldsPopulated(){

        //act
        $data = ['id'=>'12322321','followers_count'=>100];

        //arrange
        $user = InstaUserDTO::hydrate($data);

        //assert
        $this->assertEquals('12322321',$user->id);
        $this->assertEquals(100,$user->followersCount);
    }

    public function test_hydrate_id_idPopulated(){
        //act
        $data = ['id'=>'12322321'];

        //arrange
        $user = InstaUserDTO::hydrate($data);

        //assert
        $this->assertEquals('12322321',$user->id);
        $this->assertNull($user->followersCount);
    }

    public function test_hydrate_followers_followersPopulated(){
        //act
        $data = ['followers_count'=>100];

        //arrange
        $user = InstaUserDTO::hydrate($data);

        //assert
        $this->assertNull($user->id);
        $this->assertEquals(100,$user->followersCount);
    }

}
