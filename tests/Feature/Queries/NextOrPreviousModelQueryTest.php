<?php

namespace Sfneal\Datum\Tests\Feature\Queries;

use Sfneal\Datum\Tests\TestCase;
use Sfneal\Queries\NextOrPreviousModelQuery;
use Sfneal\Testing\Models\People;

class NextOrPreviousModelQueryTest extends TestCase
{
    /**
     * @var People
     */
    private $model;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Retrieve a random model that is not the first or last
        $this->model = People::query()
            ->where('person_id', '!=', People::query()->min('person_id'))
            ->where('person_id', '!=', People::query()->max('person_id'))
            ->get()
            ->shuffle()
            ->first();
    }

    public function test_next_model()
    {
        $next = (new NextOrPreviousModelQuery(People::class, $this->model->getKey()))
            ->next()
            ->execute();

        $this->assertTrue($next->getKey() > $this->model->getKey());
    }

    public function test_previous_model()
    {
        $next = (new NextOrPreviousModelQuery(People::class, $this->model->getKey()))
            ->previous()
            ->execute();

        $this->assertTrue($next->getKey() < $this->model->getKey());
    }
}
