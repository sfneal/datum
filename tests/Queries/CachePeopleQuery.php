<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Queries\Traits\PeopleBuilder;
use Sfneal\Models\Model;
use Sfneal\Queries\CacheModelQuery;

class CachePeopleQuery extends CacheModelQuery
{
    use PeopleBuilder;

    /**
     * Target Model.
     *
     * @var Model
     */
    protected $model = People::class;
}
