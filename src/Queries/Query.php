<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;

interface Query
{
    // todo: make builder() a protected method

    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    public function builder(): Builder;

    /**
     * Execute a DB query.
     *
     * @return mixed
     */
    public function execute();
}
