<?php

namespace Sfneal\Datum\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Providers\TestingServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return TestingServiceProvider::class;
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__.'/migrations/create_people_table.php.stub';

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
        People::factory()
            ->count(20)
            ->create();

        // Add custom factories
        $this->addCustomFactories();
    }

    /**
     * Add custom Factories to the model Collection.
     *
     * @return array
     */
    private static function customFactories(): array
    {
        return [
            [
                'name_first' => 'Stephen',
                'name_last' => 'Neal',
                'address' => '72 Ice House Lane',
                'city' => 'Franklin',
                'state' => 'MA',
                'zip' => '02038',
            ],
            [
                'name_first' => 'Richard',
                'name_last' => 'Neal',
                'address' => '75 Ice House Lane',
                'city' => 'Franklin',
                'state' => 'MA',
                'zip' => '02038',
            ],
        ];
    }

    /**
     * Add custom factories to the Model Collection.
     *
     * @return void
     */
    private function addCustomFactories(): void
    {
        foreach (self::customFactories() as $factory) {
            People::factory()->create($factory);
        }
    }
}
