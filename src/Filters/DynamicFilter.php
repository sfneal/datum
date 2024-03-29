<?php

namespace Sfneal\Filters;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Helpers\Strings\StringHelpers;

abstract class DynamicFilter implements Filter
{
    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var string
     */
    protected $column = 'id';

    /**
     * Apply a given search value to the builder instance.
     *
     *  - if a 'string' value is found then a single value where clause is added
     *  - if a 'array' value is found then a whereIn clause is added
     *
     * @param  Builder  $query
     * @param  mixed  $value
     * @return Builder $query
     */
    public function apply(Builder $query, $value = null)
    {
        // Set the Query
        $this->setQuery($query);

        // Remove whitespace from the value
        if (is_string($value)) {
            $value = trim($value);
        }

        // Determine if the the ID's are a comma or space separated list
        // if true, add where clause looking for an array of ID's
        if (is_string($value) && $ids = (new StringHelpers($value))->isListString()) {
            $this->query = $this->arrayValueClause($ids);
        }

        // Add where clause searching for a single Plan ID
        else {
            $this->query = $this->stringValueClause($value);
        }

        return $this->query;
    }

    /**
     * Add a where clause that searches for a single value.
     *
     * @param  string  $id
     * @return Builder
     */
    protected function stringValueClause($id)
    {
        $this->query->whereIn($this->column, (array) $id);

        return $this->query;
    }

    /**
     * Add a where clause that searches for an array of values.
     *
     * @param  array  $ids
     * @return Builder
     */
    protected function arrayValueClause(array $ids)
    {
        $this->query->whereIn($this->column, $ids);

        return $this->query;
    }

    /**
     * Set the Query Builder property.
     *
     * @param  Builder  $query
     */
    private function setQuery(Builder $query): void
    {
        $this->query = $query;
    }
}
