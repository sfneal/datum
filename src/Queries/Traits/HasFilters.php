<?php

namespace Sfneal\Queries\Traits;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\Filter;

trait HasFilters
{
    // todo: improve return type hinting

    /**
     * Retrieve an array of model attribute keys & corresponding Filter class values.
     *
     * @return array
     */
    abstract protected function queryFilters(): array;

    /**
     * Apply Filter decorators to the query if both the parameter is given and the Filter class exists.
     *
     * @param Builder $builder
     * @param array|null $filters
     * @return Builder
     */
    protected function applyFilters(Builder $builder, array $filters = null)
    {
        // Wrap scopes
        $builder->where(function (Builder $query) use ($filters) {

            // Check every parameter to see if there's a corresponding Filter class
            foreach ($filters ?? $this->filters as $filterName => $value) {

                // Apply Filter class if it exists and is a filterable attribute
                $query = self::applyFilter($query, $filterName, $value);
            }
        });

        return $builder;
    }

    /**
     * Apply a filter to a Query if the Filter class is valid.
     *
     * @param Builder $query
     * @param string $filterName
     * @param mixed $filterValue
     * @param Filter $decorator
     * @return Builder
     */
    protected function applyFilter(Builder $query, string $filterName, $filterValue = null, $decorator = null)
    {
        // Get the Filter class if none is provided
        $decorator = $decorator ?? self::getFilterClass($filterName);

        // Apply Filter class if it exists and is a filterable attribute
        if (! is_null($decorator) && self::isValidFilterClass($decorator, $filterName)) {
            $query = (new $decorator)->apply($query, $filterValue);
        }

        return $query;
    }

    /**
     * Determine if the Filter decorator class exists and is valid.
     *
     * Check that the Filter class exists or the $decorator is an object.
     * Then check that the attribute is declared as filterable.
     *
     * @param string|mixed $decorator
     * @param string $attribute
     * @return bool
     */
    private function isValidFilterClass($decorator, string $attribute): bool
    {
        return (class_exists($decorator) || is_object($decorator)) && $this->isFilterableAttribute($attribute);
    }

    /**
     * Create a filter decorator by manipulating filter name to find the corresponding filter class.
     *
     * @param $name
     * @return null|string|Filter
     */
    private function getFilterClass($name)
    {
        // Check if an array of attribute keys and Filter class values is defined
        if (self::isValidFiltersArray($this->queryFilters()) && $this->isFilterableAttribute($name)) {
            return $this->getAttributeFilter($name);
        }
    }

    /**
     * Check if the filters array is valid for querying.
     *
     * @param $filters
     * @return bool
     */
    private static function isValidFiltersArray($filters)
    {
        return ! empty($filters) && is_array($filters);
    }

    /**
     * Determine if a particular filter is in the array of filterable attributes.
     *
     * @param string $name
     * @return bool
     */
    private function isFilterableAttribute(string $name)
    {
        if (method_exists($this, 'queryFilters')) {
            return in_array($name, array_keys($this->queryFilters()));
        } else {
            return true;
        }
    }

    /**
     * Retrieve a Filter that corresponds to an attribute.
     *
     * @param string $name
     * @return string
     */
    private function getAttributeFilter(string $name): string
    {
        return $this->queryFilters()[$name];
    }
}
