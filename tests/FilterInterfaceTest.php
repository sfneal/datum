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

        $this->assertEquals(2, (new PeopleQueryWithFilters($filters))->execute()->count());
    }

    public function test_city_filter_array()
    {
        $filters = [
            'city' => [
                'Franklin',
                'Brookline'
            ],
        ];

        $this->assertEquals(3, (new PeopleQueryWithFilters($filters))->execute()->count());
    }

    public function test_name_last_filter_single()
    {
        $filters = [
            'name_last' => 'Neal',
        ];

        $this->assertEquals(2, (new PeopleQueryWithFilters($filters))->execute()->count());
    }

    public function test_name_last_filter_array()
    {
        $filters = [
            'name_last' => [
                'Neal',
                'Brady'
            ],
        ];

        $this->assertEquals(3, (new PeopleQueryWithFilters($filters))->execute()->count());
    }
}
