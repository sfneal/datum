<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Filters\NameFirstFilter;
use Sfneal\Datum\Tests\Queries\PeopleQueryWithFilters;

class FilterListStringTest extends TestCase
{
    public function test_apply_methods_exists()
    {
        $this->assertTrue(method_exists(NameFirstFilter::class, 'apply'));
    }

    public function test_name_first_filter_single()
    {
        $filters = [
            'name_first' => 'Stephen',
        ];

        $this->assertEquals(1, (new PeopleQueryWithFilters($filters))->execute()->count());
    }

    public function test_name_first_filter_array()
    {
        $filters = [
            'name_first' => [
                'Stephen',
                'Tom',
            ],
        ];

        $this->assertEquals(2, (new PeopleQueryWithFilters($filters))->execute()->count());
    }

    public function test_name_first_filter_list_string()
    {
        $filters = [
            'name_first' => 'Stephen, Tom',
        ];

        $this->assertEquals(2, (new PeopleQueryWithFilters($filters))->execute()->count());
    }
}