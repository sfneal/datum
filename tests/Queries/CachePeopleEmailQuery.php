<?php

namespace Sfneal\Datum\Tests\Queries;

use Illuminate\Database\Eloquent\Model;
use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\CacheModelQuery;

class CachePeopleEmailQuery extends CacheModelQuery
{
    /**
     * Target Model.
     *
     * @var Model
     */
    protected $model = People::class;

    /**
     * Model's attribute to cache.
     *
     * @var string
     */
    protected $attribute = 'email';
}