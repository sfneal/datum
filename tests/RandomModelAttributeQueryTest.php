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

        $exists = People::query()->where('name_first', '=', $result)->get()->first()->{$attribute};
        $this->assertIsString($result);
        $this->assertSame($exists, $result);
    }
}
