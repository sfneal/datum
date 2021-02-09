<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\NextOrPreviousModelQuery;

class NextOrPreviousModelQueryTest extends TestCase
{
    public function test_next_model()
    {
        $model = People::query()->get()->shuffle()->first();

        $next = (new NextOrPreviousModelQuery(People::class, $model->getKey()))
            ->next()
            ->execute();

        $this->assertTrue($next->getKey() > $model->getKey());
    }

    public function test_previous_model()
    {
        $model = People::query()->get()->shuffle()->first();

        $next = (new NextOrPreviousModelQuery(People::class, $model->getKey()))
            ->previous()
            ->execute();

        $this->assertTrue($next->getKey() < $model->getKey());
    }
}
