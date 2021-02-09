<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Queries\PeopleEmailQuery;
use Sfneal\Queries\CacheModelQuery;

class CacheModelQueryTest extends TestCase
{
    /**
     * @var int
     */
    private $id;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->id = People::query()->get()->shuffle()->first()->getKey();
    }

    private function getExpectedResult(): string
    {
        return People::query()->find($this->id)->email;
    }

    public function test_attribute_results_properties()
    {
        $result = (new PeopleEmailQuery($this->id))->fetch();

        $this->assertIsString($result);
        $this->assertSame($this->getExpectedResult(), $result);
    }

    public function test_attribute_result_is_cached_properties()
    {
        $query = (new PeopleEmailQuery($this->id));
        $result = $query->fetch();

        $this->assertTrue($query->isCached());
    }

    public function test_attribute_results_constructed()
    {
        $result = (new CacheModelQuery($this->id, People::class, 'email'))->fetch();

        $this->assertIsString($result);
        $this->assertSame($this->getExpectedResult(), $result);
    }

    public function test_attribute_result_is_cached_constructed()
    {
        $query = (new CacheModelQuery($this->id, People::class, 'email'));
        $result = $query->fetch();

        $this->assertTrue($query->isCached());
    }

    public function test_cache_keys_are_same()
    {
        $cacheKey1 = (new CacheModelQuery($this->id, People::class, 'email'))->cacheKey();
        $cacheKey2 = (new PeopleEmailQuery($this->id))->cacheKey();

        $this->assertSame($cacheKey1, $cacheKey2);
    }
}
