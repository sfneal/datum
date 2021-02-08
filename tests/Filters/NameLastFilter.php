<?php

namespace Sfneal\Datum\Tests\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\FilterInterface;

class NameLastFilter implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder $query
     */
    public function apply(Builder $query, $value)
    {
        $query->whereIn('name_last', (array) $value);

        return $query;
    }
}
