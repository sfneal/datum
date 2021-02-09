<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Queries\PeopleCountQuery;

class QueryTest extends TestCase
{
    public function test_execute_method()
    {
        $this->assertTrue(method_exists(PeopleCountQuery::class, 'execute'));
    }

    public function test_static_query_results()
    {
        $count = (new PeopleCountQuery)->execute();

        $this->assertIsInt($count);
        $this->assertSame(26, $count);
    }
}
