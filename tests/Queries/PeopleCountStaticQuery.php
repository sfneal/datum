<?php

namespace Sfneal\Datum\Tests\Queries;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\AbstractQueryStatic;

class PeopleCountStaticQuery extends AbstractQueryStatic
{
    /**
     * Execute a static query to retrieve the number of People records.
     *
     * @return int
     */
    public static function execute(): int
    {
        return People::query()->count();
    }
}
