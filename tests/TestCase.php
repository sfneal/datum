<?php

namespace Sfneal\Datum\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Address\Models\Address;
use Sfneal\Address\Providers\AddressServiceProvider;
use Sfneal\Helpers\Redis\Providers\RedisHelpersServiceProvider;
use Sfneal\Testing\Models\People;
use Sfneal\Testing\Providers\MockModelsServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Register package service providers®.
     *
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            MockModelsServiceProvider::class,
            AddressServiceProvider::class,
            RedisHelpersServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Migrate 'people' table
        include_once __DIR__.'/../vendor/sfneal/mock-models/database/migrations/create_people_table.php.stub';
        (new \CreatePeopleTable())->up();

        // Migrate address table
        include_once __DIR__.'/../vendor/sfneal/address/database/migrations/create_address_table.php.stub';
        (new \CreateAddressTable())->up();
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
            ->has(Address::factory())
            ->create();

        // Add custom factories
        $this->addCustomFactories();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Cache::flush();
        parent::tearDown();
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
                'data' => [
                    'name_first' => 'Stephen',
                    'name_last' => 'Neal',
                ],
                'address' => [
                    'address_1' => '72 Ice House Lane',
                    'city' => 'Franklin',
                    'state' => 'MA',
                    'zip' => '02038',
                ],
            ],
            [
                'data' => [
                    'name_first' => 'Richard',
                    'name_last' => 'Neal',
                ],
                'address' => [
                    'address_1' => '75 Ice House Lane',
                    'city' => 'Franklin',
                    'state' => 'MA',
                    'zip' => '02038',
                ],
            ],
            [
                'data' => [
                    'name_first' => 'Tahm',
                    'name_last' => 'Brady',
                ],
                'address' => [
                    'address_1' => '123 Main Street',
                    'city' => 'Brookline',
                    'state' => 'MA',
                    'zip' => '02445',
                ],
            ],
            [
                'data' => [
                    'name_first' => 'Michael',
                    'name_last' => 'Jordan',
                ],
                'address' => [
                    'address_1' => '200 Cedar Street',
                    'city' => 'Charlotte',
                    'state' => 'NC',
                    'zip' => '12345',
                ],
            ],
            [
                'data' => [
                    'name_first' => 'Jon',
                    'name_last' => 'Jones',
                ],
                'address' => [
                    'address_1' => '3000 East Street',
                    'city' => 'Albuquerque',
                    'state' => 'NM',
                    'zip' => '04523',
                ],
            ],
            [
                'data' => [
                    'name_first' => 'Peter',
                    'name_last' => 'Laviolette',
                ],
                'address' => [
                    'address_1' => '62 Winter Street',
                    'city' => 'Franklin',
                    'state' => 'MA',
                    'zip' => '02038',
                ],
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
            $person = People::factory()->create($factory['data']);

            $person->address()->create($factory['address']);
        }
    }
}
