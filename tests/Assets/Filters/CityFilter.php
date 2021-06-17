<?php

namespace Sfneal\Datum\Tests\Assets\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Address\Builders\AddressBuilder;
use Sfneal\Filters\Filter;

class CityFilter implements Filter
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
        $query->whereHas('address', function (AddressBuilder $builder) use ($value) {
            $builder->whereIn('city', (array) $value);
        });

        return $query;
    }
}
