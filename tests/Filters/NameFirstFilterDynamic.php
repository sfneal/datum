<?php

namespace Sfneal\Datum\Tests\Filters;

use Sfneal\Filters\FilterDynamic;

class NameFirstFilterDynamic extends FilterDynamic
{
    /**
     * @var string
     */
    protected $column = 'name_first';
}
