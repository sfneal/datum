<?php

namespace Sfneal\Datum\Tests\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Datum\Tests\Filters\CityFilter;
use Sfneal\Datum\Tests\Filters\NameFirstFilter;
use Sfneal\Datum\Tests\Filters\NameLastFilter;
use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\AbstractQueryWithFilters;

class PeopleQueryWithFilters extends AbstractQueryWithFilters
{
    /**
     * Array of attribute/form input name keys and Filter class values.
     *
     * @var array
     */
    public $attribute_filters = [
        'city' => CityFilter::class,
        'name_last' => NameLastFilter::class,
        'name_first' => NameFirstFilter::class,
    ];

    /**
     * Execute a DB query using filter parameters.
     *
     * @return Builder
     */
    public function execute(): Builder
    {
        // Initialize query
        $query = People::query();

        // Apply filters
        $query = $this->applyFiltersToQuery($query);

        // Return query
        return $query;
    }
}
