<?php


namespace Sfneal\Datum\Tests\Queries;


use Illuminate\Database\Eloquent\Builder;
use Sfneal\Datum\Tests\Filters\FranklinFilter;
use Sfneal\Datum\Tests\Filters\GoatFilter;
use Sfneal\Datum\Tests\Filters\MassFilter;
use Sfneal\Datum\Tests\Filters\NealFilter;
use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\AbstractQueryWithFilter;

class PeopleQueryWithFilter extends AbstractQueryWithFilter
{
    /**
     * Array of attribute/form input name keys and Filter class values.
     *
     * @var array
     */
    public $attribute_filters = [
        'goat' => GoatFilter::class,
        'neal' => NealFilter::class,
        'franklin' => FranklinFilter::class,
        'ma' => MassFilter::class,
    ];

    /**
     * Execute the query
     *
     * @return Builder
     */
    public function execute()
    {
        // Initialize query
        $query = People::query();

        // Apply filters
        $query = $this->applyFilterToQuery($query, $this->filter);

        // Return the query
        return $query;
    }
}
