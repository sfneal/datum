<?php

namespace Sfneal\Datum\Tests\Assets\Queries;

use Sfneal\Datum\Tests\Assets\Filters\CityFilter;
use Sfneal\Datum\Tests\Assets\Filters\NameFirstDynamicFilter;
use Sfneal\Datum\Tests\Assets\Filters\NameLastFilter;
use Sfneal\Datum\Tests\Assets\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\FilterableQuery;

class PeopleQueryWithFilters extends FilterableQuery
{
    use PeopleBuilder;

    /**
     * Retrieve an array of model attribute keys & corresponding Filter class values.
     *
     * @return array
     */
    protected function queryFilters(): array
    {
        return [
            'city' => CityFilter::class,
            'name_last' => NameLastFilter::class,
            'name_first' => NameFirstDynamicFilter::class,
        ];
    }
}
