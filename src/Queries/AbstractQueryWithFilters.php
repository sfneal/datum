<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Queries\Traits\ApplyFilter;

abstract class AbstractQueryWithFilters implements Query
{
    use ApplyFilter;

    // todo: add protected execute method with default functionality

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
     * Apply Filter decorators to the query if both the parameter is given and the Filter class exists.
     *
     * @param Builder $builder
     * @param array|null $filters
     * @return Builder
     */
    public function applyFiltersToQuery(Builder $builder, array $filters = null)
    {
        // Wrap scopes
        $builder->where(function (Builder $query) use ($filters) {

            // Check every parameter to see if there's a corresponding Filter class
            foreach ($filters ?? $this->filters as $filterName => $value) {

                // Apply Filter class if it exists and is a filterable attribute
                $query = self::applyFilterToQuery($query, $filterName, $value);
            }
        });

        return $builder;
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
            return in_array($filter, array_keys($this->attributeFilters())) && ! is_null($value);
        }, ARRAY_FILTER_USE_BOTH);
    }
}
