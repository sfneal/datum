<?php

namespace Sfneal\Filters;

use Illuminate\Database\Eloquent\Builder;

// todo: add tests once test data package is complete
class HasFilter implements Filter
{
    /**
     * Scope query results to models WITH particular relationships.
     *
     *  - useful for checkbox search inputs corresponding to relationship names
     *
     * @param Builder $query
     * @param array|mixed $value
     * @return Builder $builder
     */
    public function apply(Builder $query, $value): Builder
    {
        return self::execute($query, $value);
    }

    /**
     * Apply the Filter to the Query.
     *
     * @param Builder $query
     * @param array $value
     * @param bool $has
     * @return Builder
     */
    protected static function execute(Builder $query, array $value, bool $has = true): Builder
    {
        // use `has()` method for scoping to models WITH particular relationships
        // use `doesntHave()` method for scoping to models WITHOUT particular relationships
        $method = $has ? 'has' : 'doesntHave';

        // Add scope for each relationship
        foreach (array_keys((array) $value) as $relationship) {
            $query->{$method}($relationship);
        }

        return $query;
    }
}
