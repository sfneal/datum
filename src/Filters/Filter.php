<?php

namespace Sfneal\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param  Builder  $query
     * @param  mixed  $value
     * @return Builder $query
     */
    public function apply(Builder $query, $value);
}
