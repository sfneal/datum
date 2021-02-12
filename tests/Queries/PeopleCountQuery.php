<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\Query;

class PeopleCountQuery implements Query
{
    use PeopleBuilder;

    /**
     * Execute a static query to retrieve the number of People records.
     *
     * @return int
     */
    public function execute(): int
    {
        return $this->builder()->count();
    }
}
