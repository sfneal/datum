<?php

namespace Sfneal\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterNullableInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $query
     * @param null $value
     * @return Builder $query
     */
    public static function apply(Builder $query, $value = null);
}
