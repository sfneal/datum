<?php


namespace Sfneal\Datum\Tests;


use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Queries\PeopleQueryWithFilters;

class QueryWithFiltersTest extends TestCase
{
    public function test_city_filter()
    {
        $filters = [
            'city' => 'Franklin'
        ];
        $people = (new PeopleQueryWithFilters($filters))->execute();

        $this->assertEquals(2, $people->count());
    }
}
