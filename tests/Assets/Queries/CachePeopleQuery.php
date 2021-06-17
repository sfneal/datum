<?php

namespace Sfneal\Datum\Tests\Assets\Queries;

use Sfneal\Datum\Tests\Assets\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\CacheModelQuery;
use Sfneal\Testing\Models\People;

class CachePeopleQuery extends CacheModelQuery
{
    use PeopleBuilder;

    /**
     * Target Model.
     *
     * @var People
     */
    protected $model = People::class;
}
