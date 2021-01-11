<?php
declare(strict_types=1);

namespace InstaFetcherTests;


use Mockery;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

abstract class GwtTestCase extends TestCase
{
    /**
     * runs test for each fixture
     */
    public function run(TestResult $result = null): TestResult
    {
        foreach($this->fixtureProvider() as $testFixture){
            $this->initFixture($testFixture);
            $result->run($this);
        }

        return $result;
    }

    /**
     * runs the sut method to be tested
     * usually for capturing the return type, and any exceptions thrown
     */
    public abstract function when();

    /**
     * sets up mocks and class params for each test scenario
     */
    abstract function setUpClassProperties();

    /**
     * returns an list of objects,
     * each object represents a list of fields for a test
     */
    abstract function fixtureProvider(): array;

    /**
     * maps the fixture to fields in test scenario
     */
    abstract function initFixture(array $data);

    protected function tearDown(): void
    {
        Mockery::close();
    }
}