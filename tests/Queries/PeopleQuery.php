<?php

namespace Sfneal\Datum\Tests\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\Query;
use Sfneal\Queries\Traits\HasKeyParam;

class PeopleQuery implements Query
{
    use HasKeyParam;

    /**
     * Execute a DB query.
     *
     * @return Builder
     */
    public function execute(): Builder
    {
        return People::query()
            ->where('person_id', '=', $this->modelKey);
    }
}
