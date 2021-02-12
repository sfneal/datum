<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Queries\Traits\HasFilters;

abstract class AbstractQueryWithFilter implements Query
{
    use HasFilters;

    /**
     * Filter values to be passed to Filer classes.
     *
     * @var array
     */
    private $filter;

    /**
     * QueryWithFilter constructor.
     *
     * @param string $filter name of the bucket to filter by
     */
    public function __construct(string $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Execute the query.
     *
     * @return Builder
     */
    public function execute(): Builder
    {
        // Initialize query
        $query = $this->builder();

        // Apply filters
        $query = $this->applyFilter($query, $this->filter);

        // Return the query
        return $query;
    }
}
