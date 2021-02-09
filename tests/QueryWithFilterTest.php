<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Queries\PeopleQueryWithFilter;

class QueryWithFilterTest extends TestCase
{
    public function test_goat_filter()
    {
        $this->assertEquals(3, (new PeopleQueryWithFilter('goat'))->execute()->count());
    }

    public function test_neal_filter()
    {
        $this->assertEquals(2, (new PeopleQueryWithFilter('neal'))->execute()->count());
    }

    public function test_franklin_filter()
    {
        $this->assertEquals(3, (new PeopleQueryWithFilter('franklin'))->execute()->count());
    }

    public function ma_filter()
    {
        $this->assertEquals(4, (new PeopleQueryWithFilter('ma'))->execute()->count());
    }
}
