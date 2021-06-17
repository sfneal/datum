<?php

namespace Sfneal\Datum\Tests\Feature\Queries;

use Sfneal\Datum\Tests\Assets\Queries\CachePeopleEmailQuery;
use Sfneal\Datum\Tests\Assets\Queries\CachePeopleQuery;
use Sfneal\Datum\Tests\TestCase;
use Sfneal\Queries\CacheModelQuery;
use Sfneal\Testing\Models\People;

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
        $result = (new CachePeopleEmailQuery($this->id))->fetch();

        $this->assertIsString($result);
        $this->assertSame($this->getExpectedResult(), $result);
    }

    public function test_attribute_result_is_cached_properties()
    {
        $query = (new CachePeopleEmailQuery($this->id));
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

    public function test_attribute_cache_keys_are_same()
    {
        $cacheKey1 = (new CacheModelQuery($this->id, People::class, 'email'))->cacheKey();
        $cacheKey2 = (new CachePeopleEmailQuery($this->id))->cacheKey();

        $this->assertSame($cacheKey1, $cacheKey2);
    }

    public function test_model_results_properties()
    {
        $result = (new CachePeopleQuery($this->id))->fetch();

        $this->assertInstanceOf(People::class, $result);
        $this->assertEquals(People::query()->find($this->id), $result);
    }

    public function test_model_result_is_cached_properties()
    {
        $query = (new CachePeopleQuery($this->id));
        $result = $query->fetch();

        $this->assertTrue($query->isCached());
    }

    public function test_model_results_constructed()
    {
        $result = (new CacheModelQuery($this->id, People::class))->fetch();

        $this->assertInstanceOf(People::class, $result);
        $this->assertEquals(People::query()->find($this->id), $result);
    }

    public function test_model_result_is_cached_constructed()
    {
        $query = (new CacheModelQuery($this->id, People::class));
        $result = $query->fetch();

        $this->assertTrue($query->isCached());
    }

    public function test_model_cache_keys_are_same()
    {
        $cacheKey1 = (new CacheModelQuery($this->id, People::class))->cacheKey();
        $cacheKey2 = (new CachePeopleQuery($this->id))->cacheKey();

        $this->assertSame($cacheKey1, $cacheKey2);
    }
}
