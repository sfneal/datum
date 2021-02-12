<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;

interface Query
{
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
