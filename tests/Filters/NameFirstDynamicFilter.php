<?php

namespace Sfneal\Datum\Tests\Filters;

use Sfneal\Filters\DynamicFilter;

class NameFirstDynamicFilter extends DynamicFilter
{
    /**
     * @var string
     */
    protected $column = 'name_first';
}
