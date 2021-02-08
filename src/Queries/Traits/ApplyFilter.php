<?php

namespace Sfneal\Queries\Traits;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\FilterInterface;

trait ApplyFilter
{
    /**
     * Apply a filter to a Query if the Filter class is valid.
     *
     * @param Builder $query
     * @param string $filterName
     * @param mixed $filterValue
     * @param FilterInterface $decorator
     * @return Builder
     */
    public function applyFilterToQuery(Builder $query, string $filterName, $filterValue = null, $decorator = null)
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
     * @return null|string|FilterInterface
     */
    private function getFilterClass($name)
    {
        // Check if an array of attribute keys and Filter class values is defined
        if (self::isValidFiltersArray($this->attribute_filters) && $this->isFilterableAttribute($name)) {
            return $this->attribute_filters[$name];
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
        if (property_exists($this, 'attribute_filters')) {
            return in_array($name, array_keys($this->attribute_filters));
        } else {
            return true;
        }
    }
}
