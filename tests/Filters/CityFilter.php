<?php

namespace Sfneal\Filters\Tests\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\FilterListString;

class CityFilter extends FilterListString
{
    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var string Primary key column
     */
    protected $column = 'person_id';

    /**
     * Add a where clause that searches for a single value.
     *
     * @param string $value
     * @return Builder $query
     */
    protected function stringValueClause($value)
    {
        $this->query->where('city', 'LIKE', $value);

        return $this->query;
    }

    /**
     * Add a where clause that searches for an array of values.
     *
     * @param array $values
     * @return Builder $query
     */
    protected function arrayValueClause(array $values)
    {
        $this->query->where('city', function (Builder $builder) use ($values) {
            collect($values)->each(function ($value) use ($builder) {
                $builder->orWhere('city', 'LIKE', $value);
            });
        });

        return $this->query;
    }
}
