<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\CacheModelQuery;

class CachePeopleEmailQuery extends CacheModelQuery
{
    use PeopleBuilder;

    /**
     * Target Model.
     *
     * @var People
     */
    protected $model = People::class;

    /**
     * Model's attribute to cache.
     *
     * @var string
     */
    protected $attribute = 'email';
}
