<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Filters\CityFilter;
use Sfneal\Datum\Tests\Filters\NameLastFilter;
use Sfneal\Datum\Tests\Queries\PeopleQueryWithFilters;

class FilterInterfaceTest extends TestCase
{
    public function test_apply_methods_exists()
    {
        $this->assertTrue(method_exists(CityFilter::class, 'apply'));
        $this->assertTrue(method_exists(NameLastFilter::class, 'apply'));
    }

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
