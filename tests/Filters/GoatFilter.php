<?php

namespace Sfneal\Datum\Tests\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\Filter;

class GoatFilter implements Filter
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
        $query->orWhere(function (Builder $builder) {
            $builder
                ->where('name_first', '=', 'Tahm')
                ->where('name_last', '=', 'Brady');
        });

        $query->orWhere(function (Builder $builder) {
            $builder
                ->where('name_first', '=', 'Michael')
                ->where('name_last', '=', 'Jordan');
        });

        $query->orWhere(function (Builder $builder) {
            $builder
                ->where('name_first', '=', 'Jon')
                ->where('name_last', '=', 'Jones');
        });

        return $query;
    }
}
