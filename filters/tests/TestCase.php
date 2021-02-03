<?php

namespace Sfneal\Filters\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Filters\Tests\Models\People;
use Sfneal\Filters\Tests\Providers\TestingServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return TestingServiceProvider::class;
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/migrations/create_people_table.php.stub';

        (new \CreatePeopleTable())->up();
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Create model factories
        $this->models = People::factory()
            ->count(20)
            ->create();
    }
}
