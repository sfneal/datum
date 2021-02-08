<?php

namespace Sfneal\Datum\Tests\Filters;

use Sfneal\Filters\AbstractFilter;

class NameFirstFilter extends AbstractFilter
{
    /**
     * @var string
     */
    protected $column = 'name_first';
}
