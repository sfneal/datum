<?php

namespace Sfneal\Datum\Tests\Assets\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\Filter;

class FranklinFilter implements Filter
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
        $query
            ->where('city', '=', 'Franklin')
            ->where('state', '=', 'MA');

        return $query;
    }
}
