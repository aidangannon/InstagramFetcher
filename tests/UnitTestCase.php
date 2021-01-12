<?php


namespace InstaFetcherTests;


use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    protected function loadFromDotEnv(){
        Dotenv::createImmutable(getcwd())->load();
    }

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->loadFromDotEnv();
        parent::__construct($name, $data, $dataName);
    }
}