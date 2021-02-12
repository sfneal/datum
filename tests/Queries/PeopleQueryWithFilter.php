<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Filters\FranklinFilter;
use Sfneal\Datum\Tests\Filters\GoatFilter;
use Sfneal\Datum\Tests\Filters\MassFilter;
use Sfneal\Datum\Tests\Filters\NealFilter;
use Sfneal\Datum\Tests\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\AbstractQueryWithFilter;

class PeopleQueryWithFilter extends AbstractQueryWithFilter
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
