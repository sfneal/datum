<?php


namespace Sfneal\Filters;


use Illuminate\Database\Eloquent\Builder;

class PublicStatusFilter implements FilterInterface
{
    protected const COLUMN = 'public_status';

    /**
     * Apply a public_status filter to a Query
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public static function apply($query, $value)
    {
        // todo: improve this with WherePublic interface
        $query->wherePublic($value);
        return $query;
    }
}
