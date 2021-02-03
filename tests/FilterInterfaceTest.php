<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Queries\PeopleQueryWithFilters;

class FilterInterfaceTest extends TestCase
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

    public function test_name_last_filter_single()
    {
        $filters = [
            'name_last' => 'Neal',
        ];
        $people = (new PeopleQueryWithFilters($filters))->execute();

        $this->assertEquals(2, $people->count());
    }

    public function test_name_last_filter_array()
    {
        $filters = [
            'name_last' => [
                'Neal',
                'Brady'
            ],
        ];
        $people = (new PeopleQueryWithFilters($filters))->execute();

        $this->assertEquals(3, $people->count());
    }
}
