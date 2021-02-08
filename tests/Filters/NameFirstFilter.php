<?php

namespace Sfneal\Datum\Tests\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\FilterListString;

class NameFirstFilter extends FilterListString
{
    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var string
     */
    protected $column = 'name_first';

    /**
     * Add a where clause that searches for a single value.
     *
     * @param string $id
     *
     * @return Builder $query
     */
    protected function stringValueClause($id)
    {
        $this->query->whereIn($this->column, (array) $id);

        return $this->query;
    }

    /**
     * Add a where clause that searches for an array of values.
     *
     * @param array $ids
     *
     * @return Builder $query
     */
    protected function arrayValueClause(array $ids)
    {
        $this->query->whereIn($this->column, $ids);

        return $this->query;
    }
}
