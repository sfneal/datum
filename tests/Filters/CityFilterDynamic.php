<?php

namespace Sfneal\Datum\Tests\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\FilterListString;

class CityFilterDynamic extends FilterListString
{
    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var string Column name
     */
    protected $column = 'city';

    /**
     * Add a where clause that searches for a single value.
     *
     * @param string $value
     * @return Builder $query
     */
    protected function stringValueClause($value)
    {
        $this->query->where($this->column, 'LIKE', $value);

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
        $this->query->where($this->column, function (Builder $builder) use ($values) {
            collect($values)->each(function ($value) use ($builder) {
                $builder->orWhere($this->column, 'LIKE', $value);
            });
        });

        return $this->query;
    }
}
