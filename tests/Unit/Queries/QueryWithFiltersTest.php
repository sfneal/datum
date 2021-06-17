<?php

namespace Sfneal\Datum\Tests\Unit\Queries;

use Sfneal\Datum\Tests\Assets\Queries\PeopleQueryWithFilters;
use Sfneal\Datum\Tests\TestCase;

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
