<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest;


use InstaFetcher\DataAccess\DTOs\FacebookPagesDTO;
use PHPUnit\Framework\MockObject\MockObject;

abstract class Given_User_Gets_Insta_User_By_Handle extends InstaUserHttpRepositoryTestCase
{
    /**
     * @var FacebookPagesDTO|MockObject
     */
    protected FacebookPagesDTO $mockFacebookPagesDTO;
}