<?php

namespace Sfneal\Datum\Tests\Unit\Filters;


use Sfneal\Datum\Tests\Assets\Filters\CityFilter;
use Sfneal\Datum\Tests\Assets\Filters\NameLastFilter;
use Sfneal\Datum\Tests\Assets\Queries\PeopleQueryWithFilters;
use Sfneal\Datum\Tests\TestCase;

class FilterTest extends TestCase
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

        $this->assertEquals(3, (new PeopleQueryWithFilters($filters))->execute()->count());
    }

    public function test_city_filter_array()
    {
        $filters = [
            'city' => [
                'Franklin',
                'Brookline',
            ],
        ];

        $this->assertEquals(4, (new PeopleQueryWithFilters($filters))->execute()->count());
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
                'Brady',
            ],
        ];

        $this->assertEquals(3, (new PeopleQueryWithFilters($filters))->execute()->count());
    }
}
