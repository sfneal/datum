<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;

abstract class Query
{
    // todo: make builder() a protected method

    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    abstract protected function builder(): Builder;

    /**
     * Execute a DB query.
     *
     * @return mixed
     */
    abstract public function execute();
}
