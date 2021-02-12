<?php

namespace Sfneal\Datum\Tests\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Datum\Tests\Filters\CityFilter;
use Sfneal\Datum\Tests\Filters\NameFirstFilterDynamic;
use Sfneal\Datum\Tests\Filters\NameLastFilter;
use Sfneal\Datum\Tests\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\AbstractQueryWithFilters;

class PeopleQueryWithFilters extends AbstractQueryWithFilters
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

    /**
     * Execute a DB query using filter parameters.
     *
     * @return Builder
     */
    public function execute(): Builder
    {
        // Initialize query
        $query = $this->builder();

        // Apply filters
        $query = $this->applyFiltersToQuery($query);

        // Return query
        return $query;
    }
}
