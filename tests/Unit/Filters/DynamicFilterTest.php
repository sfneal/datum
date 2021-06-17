<?php

namespace Sfneal\Datum\Tests\Unit\Filters;

use Sfneal\Datum\Tests\Assets\Filters\NameFirstDynamicFilter;
use Sfneal\Datum\Tests\Assets\Queries\PeopleQueryWithFilters;
use Sfneal\Datum\Tests\TestCase;

class DynamicFilterTest extends TestCase
{
    public function test_apply_methods_exists()
    {
        $this->assertTrue(method_exists(NameFirstDynamicFilter::class, 'apply'));
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
                'Tahm',
            ],
        ];

        $this->assertEquals(2, (new PeopleQueryWithFilters($filters))->execute()->count());
    }

    public function test_name_first_filter_list_string()
    {
        $filters = [
            'name_first' => 'Stephen, Tahm',
        ];

        $this->assertEquals(2, (new PeopleQueryWithFilters($filters))->execute()->count());
    }
}
