<?php

namespace Sfneal\Datum\Tests;

use Sfneal\Datum\Tests\Models\People;
use Sfneal\Queries\RandomModelAttributeQuery;

class RandomModelAttributeQueryTest extends TestCase
{
    public function test_random_attribute_retrieved()
    {
        $modelClass = People::class;
        $attribute = 'name_first';
        $result = (new RandomModelAttributeQuery($modelClass, $attribute))->execute();
        $exists = People::query()
            ->where('name_first', '=', $result)
            ->get()
            ->first()
            ->{$attribute};

        $this->assertIsString($result);
        $this->assertSame($exists, $result);
    }

    public function test_random_attributes_retrieved()
    {
        $modelClass = People::class;
        $attribute = 'name_first';
        $results = (new RandomModelAttributeQuery($modelClass, $attribute, 5))->execute();
        $exists = People::query()
            ->whereIn('name_first', $results)
            ->get()
            ->pluck($attribute)
            ->toArray();

        $this->assertIsArray($results);
        foreach ($results as $result) {
            $this->assertContains($result, $exists);
        }
    }
}
