<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Queries\PeopleQuery;

class HasKeyParamTest extends TestCase
{
    /**
     * @var int
     */
    private $id;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Retrieve a random model that is not the first or last
        $this->id = People::query()
            ->get()
            ->shuffle()
            ->first()
            ->person_id;
    }

    public function test_has_key_param()
    {
        $expected = People::query()->find($this->id);
        $model = (new PeopleQuery($this->id))->execute()->get()->first();

        $this->assertEquals($expected, $model);
    }
}
