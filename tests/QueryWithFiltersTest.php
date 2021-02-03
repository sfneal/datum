<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Queries\PeopleQueryWithFilters;

class QueryWithFiltersTest extends TestCase
{
    public function test_city_filter_single()
    {
        $filters = [
            'city' => 'Franklin',
        ];
        $people = (new PeopleQueryWithFilters($filters))->execute();

        $this->assertEquals(2, $people->count());
    }

    public function test_city_filter_array()
    {
        $filters = [
            'city' => [
                'Franklin',
                'Brookline'
            ],
        ];
        $people = (new PeopleQueryWithFilters($filters))->execute();

        $this->assertEquals(3, $people->count());
    }
}
