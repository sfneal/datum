<?php

namespace Sfneal\Queries;

use Sfneal\Queries\Traits\HasFilters;

abstract class FilterableQuery extends Query
{
    use HasFilters;

    /**
     * Filter values to be passed to Filer classes.
     *
     * @var array
     */
    protected $filters;

    /**
     * Filter name to be used.
     *
     * @var string
     */
    protected $filter;

    /**
     * QueryWithFilters constructor.
     *
     * @param  array|string  $filters
     */
    public function __construct($filters)
    {
        // Array of Filters with dynamic values
        if (is_array($filters)) {
            // Remove invalid filters prior to executing query
            $this->filters = $this->filterFilters($filters);
        }

        // Single Filter without a dynamic value
        else {
            $this->filters = [$filters => null];
            $this->filter = $filters;
        }
    }

    /**
     * Execute a DB query using filter parameters.
     *
     * @return mixed
     */
    public function execute()
    {
        // Initialize query
        $query = $this->builder();

        // Apply filters
        $query = $this->filterQuery($query);

        // Return query
        return $query;
    }

    /**
     * Parse filters and remove all keys that are not found in the declared attributes_filters.
     *
     * @param  array  $filters  filters passed from search form
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
