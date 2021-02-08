<?php

namespace Sfneal\Datum\Tests\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\FilterInterface;

class CityFilter implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder $query
     */
    public function apply(Builder $query, $value = null)
    {
        $query->whereIn('city', (array) $value);

        return $query;
    }
}
