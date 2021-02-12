<?php

namespace Sfneal\Datum\Tests\Queries\Traits;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Datum\Tests\Models\People;

trait PeopleBuilder
{
    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return People::query();
    }
}
