<?php

namespace Sfneal\Datum\Tests\Assets\Queries;

use Sfneal\Datum\Tests\Assets\Queries\Traits\PeopleBuilder;
use Sfneal\Queries\Query;

class PeopleCountQuery extends Query
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
