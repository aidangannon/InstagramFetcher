<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest;


use InstaFetcher\DataAccess\DTOs\FacebookPagesDto;
use InstaFetcher\DataAccess\DTOs\Mapper\FacebookPagesDtoMapper;
use PHPUnit\Framework\MockObject\MockObject;

abstract class Given_User_Gets_Insta_User_By_Handle extends InstaUserHttpRepositoryTestCase
{
    /**
     * @var FacebookPagesDto|MockObject
     */
    protected FacebookPagesDtoMapper $mockFacebookPagesDtoMapper;
}