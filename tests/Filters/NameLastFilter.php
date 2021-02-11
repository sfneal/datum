<?php

namespace Sfneal\Datum\Tests\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\Filter;

class NameLastFilter implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder $query
     */
    public function apply(Builder $query, $value): Builder
    {
        $query->whereIn('name_last', (array) $value);

        return $query;
    }
}
