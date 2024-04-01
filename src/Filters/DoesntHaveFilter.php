<?php

namespace Sfneal\Filters;

use Illuminate\Database\Eloquent\Builder;

class DoesntHaveFilter extends HasFilter implements Filter
{
    /**
     * Scope query results to models WITHOUT particular relationships.
     *
     *  - useful for checkbox search inputs corresponding to relationship names
     *
     * @param  Builder  $query
     * @param  array|mixed  $value
     * @return Builder $builder
     */
    public function apply(Builder $query, $value): Builder
    {
        return self::execute($query, $value, false);
    }
}
