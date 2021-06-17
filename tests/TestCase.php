<?php

namespace Sfneal\Datum\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Lunaweb\RedisMock\Providers\RedisMockServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Datum\Tests\Models\People;
use Sfneal\Datum\Tests\Providers\TestingServiceProvider;
use Sfneal\Helpers\Redis\Providers\RedisHelpersServiceProvider;
use Sfneal\Helpers\Redis\RedisCache;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Register package service providers.
     *
     * @param Application $app
     * @return array|string
     */
    protected function getPackageProviders($app)
    {
        return [
            RedisHelpersServiceProvider::class,
            RedisMockServiceProvider::class,
            TestingServiceProvider::class,
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
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        RedisCache::flush();
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
            [
                'name_first' => 'Tahm',
                'name_last' => 'Brady',
                'address' => '123 Main Street',
                'city' => 'Brookline',
                'state' => 'MA',
                'zip' => '02445',
            ],
            [
                'name_first' => 'Michael',
                'name_last' => 'Jordan',
                'address' => '200 Cedar Street',
                'city' => 'Charlotte',
                'state' => 'NC',
                'zip' => '12345',
            ],
            [
                'name_first' => 'Jon',
                'name_last' => 'Jones',
                'address' => '3000 East Street',
                'city' => 'Albuquerque',
                'state' => 'NM',
                'zip' => '04523',
            ],
            [
                'name_first' => 'Peter',
                'name_last' => 'Laviolette',
                'address' => '62 Winter Street',
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
