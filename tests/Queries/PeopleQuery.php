<?php

namespace Sfneal\Datum\Tests\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sfneal\Datum\Tests\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\Query;
use Sfneal\Queries\Traits\HasKeyParam;

class PeopleQuery extends Query
{
    use HasKeyParam;
    use PeopleBuilder;

    /**
     * Execute a DB query.
     *
     * @return Builder
     */
    public function execute(): Builder
    {
        return $this->builder()
            ->where('person_id', '=', $this->modelKey);
    }
}
