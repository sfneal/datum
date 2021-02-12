<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Queries\Traits\ApplyFilter;

abstract class AbstractQueryWithFilters implements Query
{
    use ApplyFilter;

    /**
     * Filter values to be passed to Filer classes.
     *
     * @var array
     */
    public $filters;

    /**
     * QueryWithFilters constructor.
     *
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        // Remove invalid filters prior to executing query
        $this->filters = $this->filterFilters($filters);
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

    /**
     * Parse filters and remove all keys that are not found in the declared attributes_filters.
     *
     * @param array $filters filters passed from search form
     * @return array
     */
    private function filterFilters(array $filters): array
    {
        return array_filter($filters, function ($value, $filter) {

            // Return true if the filter is a filterable attribute
            return in_array($filter, array_keys($this->queryFilters())) && ! is_null($value);
        }, ARRAY_FILTER_USE_BOTH);
    }
}
