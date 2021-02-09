<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\AbstractQuery;

class PeopleCountQuery extends AbstractQuery
{
    /**
     * Execute a static query to retrieve the number of People records.
     *
     * @return int
     */
    public function execute(): int
    {
        return People::query()->count();
    }
}
