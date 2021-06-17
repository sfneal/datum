<?php

namespace Sfneal\Datum\Tests\Assets\Queries\Traits;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Testing\Models\People;

trait PeopleBuilder
{
    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    protected function builder(): Builder
    {
        return People::query();
    }
}
