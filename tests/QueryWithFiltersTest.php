<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Queries\PeopleQueryWithFilters;

class QueryWithFiltersTest extends TestCase
{
    public function test_multiple_filters()
    {
        $filters = [
            'name_last' => [
                'Neal',
                'Brady',
            ],
            'city' => [
                'Brookline',
                'Boston',
            ],
        ];

        $this->assertEquals(1, (new PeopleQueryWithFilters($filters))->execute()->count());
    }
}
