<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Queries\PeopleCountStaticQuery;

class QueryStaticTest extends TestCase
{
    public function test_execute_method()
    {
        $this->assertTrue(method_exists(PeopleCountStaticQuery::class, 'execute'));
    }

    public function test_static_query_results()
    {
        $count = PeopleCountStaticQuery::execute();

        $this->assertIsInt($count);
        $this->assertSame(26, $count);
    }
}
