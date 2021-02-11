<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\Interfaces\Query;

class PeopleCountQuery implements Query
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
