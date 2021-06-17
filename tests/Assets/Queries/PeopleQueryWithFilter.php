<?php

namespace Sfneal\Datum\Tests\Assets\Queries;

use Sfneal\Datum\Tests\Assets\Filters\FranklinFilter;
use Sfneal\Datum\Tests\Assets\Filters\GoatFilter;
use Sfneal\Datum\Tests\Assets\Filters\MassFilter;
use Sfneal\Datum\Tests\Assets\Filters\NealFilter;
use Sfneal\Datum\Tests\Assets\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\FilterableQuery;

class PeopleQueryWithFilter extends FilterableQuery
{
    use PeopleBuilder;

    /**
     * Retrieve an array of model attribute keys & corresponding Filter class values.
     *
     * @return array
     */
    protected function queryFilters(): array
    {
        return [
            'goat' => GoatFilter::class,
            'neal' => NealFilter::class,
            'franklin' => FranklinFilter::class,
            'ma' => MassFilter::class,
        ];
    }
}
