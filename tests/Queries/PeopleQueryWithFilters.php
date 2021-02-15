<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Filters\CityFilter;
use Sfneal\Datum\Tests\Filters\NameFirstFilterDynamic;
use Sfneal\Datum\Tests\Filters\NameLastFilter;
use Sfneal\Datum\Tests\Queries\Traits\PeopleBuilder;
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
            'name_first' => NameFirstFilterDynamic::class,
        ];
    }
}
