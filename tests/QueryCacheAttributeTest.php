<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Queries\PeopleEmailQuery;
use Sfneal\Helpers\Redis\RedisCache;

class QueryCacheAttributeTest extends TestCase
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

    public function test_query_results()
    {
        $result = (new PeopleEmailQuery($this->id))->fetch();

        $this->assertIsString($result);
        $this->assertSame($this->getExpectedResult(), $result);
    }

    public function test_result_is_cached()
    {
        $query = (new PeopleEmailQuery($this->id));
        $result = $query->fetch();

        $this->assertTrue(RedisCache::exists($query->cacheKey()));
    }
}
